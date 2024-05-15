import csv


def write_writer():
    with open('dados_escrito.csv', mode='w', newline='') as csv_file:
        fieldnames = ["Pressao", "Temperatura", "Unidade"]
        writer = csv.DictWriter(csv_file, fieldnames=fieldnames)
        writer.writeheader()
        writer.writerow({"Pressao": 15.6, "Temperatura": 20.1, "Unidade": 30.3})
        writer.writerow({"Pressao": 16.3, "Temperatura": 19.8, "Unidade": 27.1})
        writer.writerow({"Pressao": 15.3, "Temperatura": 20.2, "Unidade": 28.3})
        writer.writerow({"Pressao": 16.1, "Temperatura": 20.5, "Unidade": 27.7})
        writer.writerow({"Pressao": 15.8, "Temperatura": 19.7, "Unidade": 29.2})


def write_dict():
    with open('dados_escrito.csv', mode='w', newline='') as csv_file:
        fieldnames = ["Pressao", "Temperatura", "Unidade"]
        writer = csv.DictWriter(csv_file, fieldnames=fieldnames)
        writer.writeheader()
        writer.writerow({"Pressao": 15.6, "Temperatura": 20.1, "Unidade": 30.3})
        writer.writerow({"Pressao": 16.3, "Temperatura": 19.8, "Unidade": 27.1})
        writer.writerow({"Pressao": 15.3, "Temperatura": 20.2, "Unidade": 28.3})
        writer.writerow({"Pressao": 16.1, "Temperatura": 20.5, "Unidade": 27.7})
        writer.writerow({"Pressao": 15.8, "Temperatura": 19.7, "Unidade": 29.2})


def imprimir_csv(nome_ficheiro):
    with open(nome_ficheiro, 'r') as ficheiro_csv:
        leitor = csv.reader(ficheiro_csv, delimiter=';')
        for linha in leitor:
            print(linha)


def ler_csv(nome_ficheiro):
    resultado = []
    with open(nome_ficheiro, 'r') as ficheiro_csv:
        leitor = csv.reader(ficheiro_csv, delimiter=';')
        for linha in leitor:
            resultado.append(linha)
        return resultado


print(ler_csv("dados_escrito.csv"))
imprimir_csv("dados_escrito.csv")
write_dict()
