import urllib.request
import pypdf
import os
import ssl

# Bypass SSL certificate verification if needed
ssl._create_default_https_context = ssl._create_unverified_context

url = "https://drive.google.com/uc?export=download&id=1qucNCvXKKfXm8XjP14hRYRE0buqa2vKD"
pdf_path = "scratch/B1_B4.pdf"
output_path = "scratch/B1_B4_extracted.txt"

print(f"Downloading from {url}...")
try:
    urllib.request.urlretrieve(url, pdf_path)
    print(f"Downloaded successfully to {pdf_path}")
except Exception as e:
    print(f"Error downloading: {e}")
    exit(1)

if not os.path.exists(pdf_path):
    print(f"Error: {pdf_path} not found.")
    exit(1)

print(f"Reading {pdf_path}...")
try:
    reader = pypdf.PdfReader(pdf_path)
    print(f"Total pages: {len(reader.pages)}")

    with open(output_path, "w", encoding="utf-8") as f:
        for i, page in enumerate(reader.pages):
            text = page.extract_text()
            f.write(f"--- PAGE {i+1} ---\n")
            f.write(text)
            f.write("\n\n")

    print(f"Extraction completed! Text saved to {output_path}")
except Exception as e:
    print(f"Error extracting text: {e}")
