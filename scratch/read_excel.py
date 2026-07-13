import pandas as pd
df = pd.read_excel('data_dip.csv', header=None)
for i in range(10):
    print(f"Row {i}:", df.iloc[i].tolist())
