def multip(x, y):
    print(f"{x} X {y} = {x*y}")
def tabuada(inicio, fim):
    for i in range(inicio, fim+1):
        print(f"Tabuada do número {i}")
        for j in range(1, 11):
            multip(i, j)
        print()
tabuada(11, 20)