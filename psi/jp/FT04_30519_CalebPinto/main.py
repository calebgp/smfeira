def read_grades():
    with open("notas.txt", "r") as gradesFile:
        return gradesFile.read().splitlines()


def read_students():
    with open("classe.txt", "r") as classFile:
        return classFile.read().splitlines()


def search_grades(query):
    idx = 0
    if query.isdigit():
        idx = int(query) - 1
    else:
        students = read_students()
        for student in students:
            if query.lower() in student.lower():
                idx = students.index(student)
    grade = read_grades()[idx]
    return grade


pesq = input("Digite o número ou o nome do aluno a pesquisar: ")
print(search_grades(pesq))
