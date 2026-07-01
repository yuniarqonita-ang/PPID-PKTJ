import pypdf
import os

pdf_path = "scratch/D1.pdf"
output_path = "scratch/D1_extracted.txt"

if not os.path.exists(pdf_path):
    print(f"Error: {pdf_path} not found.")
    exit(1)

print(f"Reading {pdf_path}...")
reader = pypdf.PdfReader(pdf_path)
print(f"Total pages: {len(reader.pages)}")

with open(output_path, "w", encoding="utf-8") as f:
    for i, page in enumerate(reader.pages):
        text = page.extract_text()
        f.write(f"--- PAGE {i+1} ---\n")
        f.write(text)
        f.write("\n\n")

print(f"Extraction completed! Text saved to {output_path}")
