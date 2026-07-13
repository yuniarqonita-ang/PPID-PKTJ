with open('data_dip.csv', 'r', encoding='latin1') as f:
    for i in range(5):
        print(repr(f.readline()))
