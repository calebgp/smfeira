import sqlite3


class Student:

    def __init__(self, code, name, age, local, clss, course):
        self.code = code
        self.name = name
        self.age = age
        self.local = local
        self.clss = clss
        self.course = course

    def str_name_age(self):
        return f"Nome: {self.name} - Idade: {self.age}"

    def __str__(self):
        return f"\nAluno {self.code}: \nCódigo: {self.code}\nNome: {self.name}\nIdade: {self.age}\nLocalidade: {self.local}\nTurma: {self.clss}\nCurso: {self.course}"


def connect_db():
    try:
        con = sqlite3.connect('school.db')
        cur = con.cursor()
        return con, cur
    except Exception as e:
        print(f"Erro ao conectar ao banco de dados: {e}")
        exit()


def create_table(con, cur):
    try:
        cur.execute(
            '''CREATE TABLE IF NOT EXISTS students(code TEXT PRIMARY KEY, name TEXT, local TEXT, age INTEGER ,class TEXT, course TEXT)'''
        )
        con.commit()
        print("Tabela criada com sucesso!")
    except Exception as e:
        print(f"Erro ao criar tabela: {e}")
    con.commit()


def insert_data(con, cur):
    while True:
        try:
            code = int(input("Digite o código do aluno: "))
            name = input("Digite o nome do aluno: ")
            age = int(input("Digite a idade do aluno: "))
            local = input("Digite a localidade do aluno: ")
            clss = input("Digite a turma do aluno: ")
            course = input("Digite o curso do aluno: ")

            cur.execute(
                f"""INSERT INTO students VALUES ('{code}', '{name}' ,'{local}', {age} ,'{clss}', '{course}')"""
            )
            print("Dados inseridos com sucesso!")
            break
        except ValueError as e:
            print(f"Valor inválido: {e}")
        except Exception as e:
            print(f"Erro ao inserir dados: {e}")
        con.commit()


def print_student(tup):
    student = Student(*tup)
    print(student)


def print_student_name_age(tup):
    student = student = Student(
        name=tup[0],
        age=tup[1],
        code=None,
        clss=None,
        course=None,
        local=None,
    )
    print(student.str_name_age())


def list_data(con, cur):
    try:
        cur.execute("""SELECT * FROM students""")
        print("Listagem de Alunos:")
        for linha in cur.fetchall():
            print_student(linha)
    except Exception as e:
        print(f"Erro ao listar dados: {e}")
    con.commit()


def list_data_sorted_name(con, cur):
    try:
        cur.execute("""SELECT * FROM students order by name""")
        print("Listagem de Alunos Ordenados pelo Nome:")
        for linha in cur.fetchall():
            print_student(linha)
    except Exception as e:
        print(f"Erro ao listar dados: {e}")
    con.commit()


def list_name_age(con, cur):
    try:
        cur.execute("""SELECT name, age FROM students""")
        print("Listagem Campos do aluno (nome, idade):")
        for linha in cur.fetchall():
            print_student_name_age(linha)
    except Exception as e:
        print(f"Erro ao listar dados: {e}")
    con.commit()


def list_by_class(con, cur):
    while True:
        try:
            clss = input("Digite a turma dos alunos: ")

            cur.execute(f"""SELECT * FROM students WHERE class = {clss}""")
            print(f"Listagem de alunos da turma {clss}:")
            for linha in cur.fetchall():
                print_student(linha)
            break
        except ValueError as e:
            print(f"Código inválido: {e}")
        except Exception as e:
            print(f"Erro a pesquisar dados: {e}")
    con.commit()


def list_by_course(con, cur):
    while True:
        try:
            course = input("Digite o curso dos alunos: ")

            cur.execute(f"""SELECT * FROM students WHERE course = {course}""")
            print(f"Listagem de alunos do curso {course}:")
            for linha in cur.fetchall():
                print_student(linha)
            break
        except ValueError as e:
            print(f"Código inválido: {e}")
        except Exception as e:
            print(f"Erro a pesquisar dados: {e}")
    con.commit()


def list_by_query_name(con, cur):
    while True:
        try:
            query = input("Digite a sequência de caracteres do nome: ")

            cur.execute(
                f"""SELECT * FROM students WHERE name LIKE '%{query}%'""")
            print(f"Listagem de alunos com esta sequência no nome {query}:")
            for linha in cur.fetchall():
                print_student(linha)
            break
        except ValueError as e:
            print(f"Código inválido: {e}")
        except Exception as e:
            print(f"Erro ao pesquisar dados: {e}")
    con.commit()


def delete_data(con, cur):
    while True:
        try:
            code = int(input("Digite o Código do aluno a ser excluído: "))

            cur.execute(f"""DELETE FROM students WHERE code = {code}""")
            print(f"Aluno com Código {code} excluído com sucesso!")
            break
        except ValueError as e:
            print(f"Código inválido: {e}")
        except Exception as e:
            print(f"Erro ao excluir dados: {e}")
    con.commit()


def main():
    con, cur = connect_db()

    while True:
        print("\nMenu de Operações do Caleb:")
        print("1 - Criar tabela")
        print("2 - Inserir aluno")
        print("3 - Listar alunos")
        print("4 - Listar alunos ordenados pelo nome")
        print("5 - Listar alunos de uma determinada turma")
        print("6 - Listar alunos de um determinado curso")
        print(
            "7 - Listar alunos com uma determinada sequência de caracteres no nome"
        )
        print("8 - Eliminar Alunos")
        print("9 - Sair")

        try:
            opcao = int(input("Escolha uma opção: "))

            if opcao == 1:
                create_table(con, cur)
            elif opcao == 2:
                insert_data(con, cur)
            elif opcao == 3:
                list_data(con, cur)

            elif opcao == 4:
                list_data_sorted_name(con, cur)
            elif opcao == 5:
                list_by_class(con, cur)
            elif opcao == 6:
                list_by_course(con, cur)
            elif opcao == 7:
                list_by_query_name(con, cur)
            elif opcao == 8:
                delete_data(con, cur)
            elif opcao == 9:
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
