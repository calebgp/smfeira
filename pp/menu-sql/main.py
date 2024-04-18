import sqlite3

con = sqlite3.connect('users.db')
cur = con.cursor()


def create_table():
    cur.execute('''CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY, name TEXT, age INTEGER)''')
    con.commit()


def insert_data():
    nome = input('Digite o nome: ')
    age = int(input('Digite a idade: '))
    cur.execute("""INSERT INTO users (name, age) VALUES ('{}', {})""".format(nome, age))
    con.commit()


def list_data():
    cur.execute("""SELECT * FROM users""")
    for linha in cur.fetchall():
        print(linha)


def delete_data():
    id = input('Digite o id do Utilizador a ser excluido: ')
    cur.execute("""DELETE FROM users WHERE id = {}""".format(id))
    con.commit()


welcomeMessage = """
Bem-vindo as operações do Caleb
1 - Criar Tabela De Dados
2 - Inserir Dados na Tabela
3 - Listagem dos dados da Tabela
4 - Eliminar Dados da Tabela
5 - Sair do programa
Escolha uma das opções acima: 
"""
while True:
    match (input(welcomeMessage)):
        case "1":
            create_table()
        case "2":
            insert_data()
        case "3":
            list_data()
        case "4":
            delete_data()
        case "5":
            break
        case _:
            print("Opção inválida escolha outra")
