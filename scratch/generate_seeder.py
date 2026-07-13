import pandas as pd
import math
import json

def clean_val(val):
    if pd.isna(val):
        return ""
    return str(val).strip()

df = pd.read_excel('data_dip.csv', header=None)

# Find the row where 'NO' is
header_row_index = -1
for i, row in df.iterrows():
    if str(row[0]).strip().upper() == 'NO':
        header_row_index = i
        break

if header_row_index == -1:
    print("Could not find table header!")
    exit(1)

records = []
current_kategori = "INFORMASI PUBLIK"

# Process rows above the header to find the initial category
for i in range(header_row_index - 1, 0, -1):
    val = clean_val(df.iloc[i][0])
    if val and 'INFORMASI' in val.upper():
        current_kategori = val.title()
        break

for i in range(header_row_index + 1, len(df)):
    row = df.iloc[i]
    col0 = clean_val(row[0])
    col1 = clean_val(row[1])
    
    if col0 == '' and col1 != '' and 'INFORMASI' in col1.upper():
        current_kategori = col1.title()
        continue
    
    if col0 == '' and col1 != '' and 'INFORMASI' in col0.upper():
        current_kategori = col0.title()
        continue
        
    if col0 != '' and col1 == '' and 'INFORMASI' in col0.upper():
        current_kategori = col0.title()
        continue
        
    if col0.isdigit() or (col0 and col1):
        # We have a valid row
        judul_informasi = col1
        isi_informasi = clean_val(row[2])
        pejabat_penguasa = clean_val(row[3])
        penanggung_jawab = clean_val(row[4])
        bentuk_informasi = clean_val(row[5])
        waktu_pembuatan = clean_val(row[6])
        jangka_waktu = clean_val(row[7])
        
        if not judul_informasi:
            continue
            
        records.append({
            'judul_informasi': judul_informasi,
            'kategori': current_kategori,
            'isi_informasi': isi_informasi,
            'pejabat_penguasa': pejabat_penguasa,
            'penanggung_jawab': penanggung_jawab,
            'waktu_pembuatan': waktu_pembuatan,
            'bentuk_informasi': bentuk_informasi,
            'jangka_waktu': jangka_waktu,
            'aktif': 1,
            'created_at': "2026-01-01 00:00:00",
            'updated_at': "2026-01-01 00:00:00"
        })

php_array = "[\n"
for rec in records:
    php_array += "    [\n"
    for k, v in rec.items():
        if isinstance(v, int):
            php_array += f"        '{k}' => {v},\n"
        else:
            val = str(v).replace("'", "\\'")
            php_array += f"        '{k}' => '{val}',\n"
    php_array += "    ],\n"
php_array += "]"

seeder_content = f"""<?php

namespace Database\\Seeders;

use Illuminate\\Database\\Seeder;
use Illuminate\\Support\\Facades\\DB;

class DipSeeder extends Seeder
{{
    public function run()
    {{
        DB::table('daftar_informasis')->truncate();
        
        $data = {php_array};

        foreach (array_chunk($data, 100) as $chunk) {{
            DB::table('daftar_informasis')->insert($chunk);
        }}
    }}
}}
"""

with open('database/seeders/DipSeeder.php', 'w', encoding='utf-8') as f:
    f.write(seeder_content)

print(f"Generated DipSeeder.php with {len(records)} records!")
