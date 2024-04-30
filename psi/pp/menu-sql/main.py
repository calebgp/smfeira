import sqlite3


def connect_db():
    try:
        con = sqlite3.connect('ginasios.db')
        cur = con.cursor()
        return con, cur
    except Exception as e:
        print(f"Erro ao conectar ao banco de dados: {e}")
        exit()

def create_table(con, cur):
    try:
        cur.execute('''CREATE TABLE IF NOT EXISTS ginasios(codigo_ginasio INTEGER PRIMARY KEY, localidade TEXT, num_atletas INTEGER, num_desportos INTEGER)''')
        con.commit()
        print("Tabela criada com sucesso!")
    except Exception as e:
        print(f"Erro ao criar tabela: {e}")

def insert_data(con, cur):
    while True:
        try:
            codigo_ginasio = int(input("Digite o código do ginásio: "))
            local = input("Digite a localidade do ginásio: ")
            num_atletas = int(input("Digite o número de atletas: "))
            num_desportos = int(input("Digite o número de desportos: "))

            cur.execute(f"""INSERT INTO ginasios VALUES ({codigo_ginasio}, '{local}', {num_atletas}, {num_desportos})""")
            con.commit()
            print("Dados inseridos com sucesso!")
            break
        except ValueError as e:
            print(f"Valor inválido: {e}")
        except Exception as e:
            print(f"Erro ao inserir dados: {e}")

def list_data(con, cur):
    try:
        cur.execute("""SELECT * FROM ginasios""")
        print("Listagem de Ginásios:")
        for linha in cur.fetchall():
            print(linha)
    except Exception as e:
        print(f"Erro ao listar dados: {e}")

def delete_data(con, cur):
    while True:
        try:
            id = int(input("Digite o ID do ginásio a ser excluído: "))

            cur.execute(f"""DELETE FROM ginasios WHERE codigo_ginasio = {id}""")
            con.commit()
            print(f"Ginásio com ID {id} excluído com sucesso!")
            break
        except ValueError as e:
            print(f"ID inválido: {e}")
        except Exception as e:
            print(f"Erro ao excluir dados: {e}")

def main():
    con, cur = connect_db()

    while True:
        print("\nMenu de Operações do Caleb:")
        print("1 - Criar Tabela")
        print("2 - Inserir Dados")
        print("3 - Listar Dados")
        print("4 - Eliminar Dados")
        print("5 - Sair")
    
        try:
            opcao = int(input("Escolha uma opção: "))
    
            if opcao == 1:
                create_table(con, cur)
            elif opcao == 2:
                insert_data(con, cur)
            elif opcao == 3:
                list_data(con, cur)
            elif opcao == 4:
                delete_data(con, cur)
            elif opcao == 5:
                print("Saindo do programa...")
                break
            else:
                print("Opção inválida. Tente novamente.")
    
        except ValueError as e:
            print(f"Valor inválido: {e}")
        except Exception as e:
            print(f"Erro inesperado: {e}")
    
    con.close()
if __name__ == "__main__":
    main()
