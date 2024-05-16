import os

diretorio = input("Digite o nome do diretório a ser criado: ")

if not os.path.exists(diretorio):
    os.makedirs(diretorio)
    print("Diretório criado com sucesso!")
else:
    print(f"O diretório {diretorio} já existe.")
