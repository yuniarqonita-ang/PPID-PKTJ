import re

with open("scratch/B1_B4_extracted.txt", "r", encoding="utf-8") as f:
    lines = f.readlines()

requests = []
channel_counts = {"Media Sosial": 0, "E-PPID/Website": 0, "Lainnya": 0}
fulfilled_count = 0
topics = []

# Regex to match date pattern DD/MM/YYYY
date_pattern = re.compile(r'\b\d{2}/\d{2}/2024\b')

for line in lines:
    line = line.strip()
    if date_pattern.search(line):
        requests.append(line)
        
        # Check channel
        if "Media Sosial" in line or "Medsos" in line:
            channel_counts["Media Sosial"] += 1
        elif "E-PPID/Website" in line or "Website" in line or "E-PPID" in line:
            channel_counts["E-PPID/Website"] += 1
        else:
            channel_counts["Lainnya"] += 1
            
        # Check status
        if "Dipenuhi" in line:
            fulfilled_count += 1
            
        # Extract keywords for topics
        if "Sipencatar" in line or "sipencatar" in line:
            topics.append("Penerimaan Taruna Baru (Sipencatar)")
        elif "Biaya" in line or "biaya" in line:
            topics.append("Biaya Pendidikan")
        elif "Tinggi badan" in line or "tinggi badan" in line or "Tinggi Badan" in line:
            topics.append("Persyaratan Tinggi Badan")
        elif "IPS" in line or "jurusan IPS" in line:
            topics.append("Persyaratan Jurusan Sekolah (IPS/SMK)")
        elif "TOEFL" in line or "Toefl" in line:
            topics.append("Tes TOEFL ITP")
        elif "Kerjasama" in line or "kerjasama" in line or "Audiensi" in line or "audiensi" in line:
            topics.append("Kerjasama / Kemitraan")

print(f"Total Requests Found: {len(requests)}")
print(f"Fulfilled Requests: {fulfilled_count} ({fulfilled_count/len(requests)*100:.1f}%)")
print("Channels Breakdown:")
for ch, cnt in channel_counts.items():
    print(f"  - {ch}: {cnt} ({cnt/len(requests)*100:.1f}%)")

print("\nSample Top Topics:")
from collections import Counter
topic_counts = Counter(topics)
for topic, count in topic_counts.most_common(5):
    print(f"  - {topic}: {count} kali ditanyakan")
