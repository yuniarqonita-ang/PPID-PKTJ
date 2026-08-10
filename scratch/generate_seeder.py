import pandas as pd
import re
import os

excel_file = 'data_dip_real.xlsx'
if not os.path.exists(excel_file):
    print(f"Error: {excel_file} not found")
    exit(1)

xl = pd.ExcelFile(excel_file)

data_entries = []
dik_entries = []

# Helper to escape PHP single-quoted string
def php_escape(val):
    if val is None or pd.isna(val):
        return ""
    val_str = str(val).strip()
    # Replace backslashes first, then single quotes
    return val_str.replace('\\', '\\\\').replace("'", "\\'")

# Sheets mapping
sheets_info = [
    ('DIP Setiap Saat', 'informasi-setiap-saat'),
    ('DIP Sertamerta', 'informasi-serta-merta'),
    ('DIP Berkala', 'informasi-berkala'),
    ('DIK', 'informasi-dikecualikan')
]

for sheet_name, category in sheets_info:
    if sheet_name not in xl.sheet_names:
        print(f"Warning: Sheet {sheet_name} not found in Excel file.")
        continue
        
    df = pd.read_excel(excel_file, sheet_name=sheet_name, header=None)
    print(f"Processing sheet: {sheet_name} ({len(df)} rows)")
    
    for idx in range(6, len(df)):
        row_vals = df.iloc[idx].tolist()
        clean_row = [str(x).strip() if pd.notna(x) else '' for x in row_vals]
        
        # Check if first cell is a number
        no_val = clean_row[0].strip()
        if no_val.endswith('.0'):
            no_val = no_val[:-2]
        if not no_val or not no_val.isdigit():
            continue
            
        # Resolve Link: column 10 (sensor), column 9 (preview), column 8 (asli)
        # For DIK, check the same columns
        link = ''
        for col_idx in [10, 9, 8]:
            if col_idx < len(clean_row):
                val = clean_row[col_idx]
                if val and val != 'nan' and val != 'Tanpa Preview' and val != '-':
                    link = val
                    break
                    
        # Skip if no document link is found
        if not link:
            continue
            
        # Extract Year from Tempat & Waktu Pembuatan (Column 6)
        year = '2025'
        if len(clean_row) > 6:
            waktu_val = clean_row[6]
            year_match = re.search(r'\b(20\d{2})\b', waktu_val)
            if year_match:
                year = year_match.group(1)
                
        created_at_str = f"{year}-01-01 00:00:00"
        
        # Prefix local filenames with storage path
        if not re.match(r'^https?://', link, re.IGNORECASE):
            if category == 'informasi-dikecualikan':
                link = 'storage/informasi/dikecualikan/' + link
            else:
                link = 'storage/daftar-informasi/' + link

        # Mapping fields
        title = clean_row[1]
        desc = clean_row[2]
        pejabat = clean_row[3] if len(clean_row) > 3 else ''
        penerbit = clean_row[4] if len(clean_row) > 4 else ''
        bentuk = clean_row[5] if len(clean_row) > 5 else ''
        waktu = clean_row[6] if len(clean_row) > 6 else ''
        jangka = clean_row[7] if len(clean_row) > 7 else ''
        
        # For DIK, if it is DIK category, we seed to both tables
        if category == 'informasi-dikecualikan':
            # 1. To daftar_informasis
            data_entries.append({
                'judul_informasi': title,
                'kategori': category,
                'isi_informasi': desc,
                'pejabat_penguasa': pejabat,
                'penanggung_jawab': penerbit,
                'penerbit_informasi': penerbit,
                'bentuk_informasi': bentuk,
                'tempat_pembuatan': 'Tegal',
                'waktu_pembuatan': waktu,
                'jangka_waktu': jangka,
                'file_informasi': link,
                'aktif': 1,
                'created_at': created_at_str,
                'updated_at': created_at_str,
            })
            # 2. To informasi_dikecualikans
            dik_entries.append({
                'judul': title,
                'deskripsi': desc,
                'tanggal': f"{year}-01-01",
                'jangka_waktu': jangka,
                'penanggung_jawab': penerbit,
                'file_path': link,
                'file_name': 'Dokumen',
                'file_size': '-',
                'file_type': 'PDF',
                'aktif': 1,
                'is_blurred': 0,
                'bisa_download': 1,
                'created_at': created_at_str,
                'updated_at': created_at_str,
            })
        else:
            data_entries.append({
                'judul_informasi': title,
                'kategori': category,
                'isi_informasi': desc,
                'pejabat_penguasa': pejabat,
                'penanggung_jawab': penerbit,
                'penerbit_informasi': penerbit,
                'bentuk_informasi': bentuk,
                'tempat_pembuatan': 'Tegal',
                'waktu_pembuatan': waktu,
                'jangka_waktu': jangka,
                'file_informasi': link,
                'aktif': 1,
                'created_at': created_at_str,
                'updated_at': created_at_str,
            })

# Generate Seeder PHP code
php_code = r"""<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DipSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed daftar_informasis
        DB::table('daftar_informasis')->truncate();

        $data = [
"""

for entry in data_entries:
    php_code += "        [\n"
    for k, v in entry.items():
        if isinstance(v, int):
            php_code += f"            '{k}' => {v},\n"
        else:
            php_code += f"            '{k}' => '{php_escape(v)}',\n"
    php_code += "        ],\n"

php_code += """        ];

        foreach (array_chunk($data, 50) as $chunk) {
            DB::table('daftar_informasis')->insert($chunk);
        }

        // 2. Seed informasi_dikecualikans
        DB::table('informasi_dikecualikans')->truncate();

        $data_dik = [
"""

for entry in dik_entries:
    php_code += "        [\n"
    for k, v in entry.items():
        if isinstance(v, int):
            php_code += f"            '{k}' => {v},\n"
        else:
            php_code += f"            '{k}' => '{php_escape(v)}',\n"
    php_code += "        ],\n"

php_code += """        ];

        foreach (array_chunk($data_dik, 50) as $chunk) {
            DB::table('informasi_dikecualikans')->insert($chunk);
        }
    }
}
"""

seeder_path = 'database/seeders/DipSeeder.php'
with open(seeder_path, 'w', encoding='utf-8') as f:
    f.write(php_code)

print(f"Successfully generated {seeder_path} with {len(data_entries)} DIP entries and {len(dik_entries)} DIK entries!")
