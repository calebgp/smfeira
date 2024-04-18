def create_matrix():
    matrix = [[0 for i in range(10)] for j in range(10)]
    for i in range(10):
        matrix[i][i] = 1
    return matrix


def write_matrix(matriz, file_name):
    with open(file_name, "w") as f:
        for linha in matriz:
            f.write(" ".join(str(x) for x in linha))
            f.write("\n")


matriz = create_matrix()
write_matrix(matriz, "matrix.txt")
