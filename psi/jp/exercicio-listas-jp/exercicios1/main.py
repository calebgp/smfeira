def contar_consoantes(vetor):
    consoantes = 'bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ'
    t_consoantes = 0
    c_lidas = []

    for char in vetor:
        if char in consoantes:
            t_consoantes += 1
            c_lidas.append(char)

    return t_consoantes, c_lidas
def readGrades():
    matriz  = [[0 for _ in range(4) ] for _ in range(10)]
    for i in range(10):
        print(f"Aluno {i+1}")
        for j in range(4):
            matriz[i][j] = float(input(f"Digite a {j+1} nota: "))
    return  matriz
def readPersons():
    ages = [];
    heights = []
    for i in range(5):
        print(f"Pessoa {i + 1}")
        age = int(input("Idade: "))
        height = float(input("Altura: "))
        ages.append(age)
        heights.append(height)
    return ages, heights
    
def readArray(i):
    v = [0] * i
    for i in range(i):
        v[i] = input(f"Digite o {i+1} numero do vetor: ")
    return v
def readArrayInt(i):
    v = [0] * i
    for i in range(i):
        v[i] = int(input(f"Digite o {i+1} numero do vetor: "))
    return v
def readArrayFloat(i):
    v = [0] * i
    for i in range(i):
        v[i] = float(input(f"Digite o {i+1} numero do vetor: "))
    return v

def ex1():
    nums = readArrayInt(5)
    for n in nums:
        print(n)
def ex2():
    nums = readArrayFloat(10)
    nums.reverse()
    print(f"Números invertidos: {nums}")
def ex3():
    grades = readArrayFloat(4)
    media = sum(grades)/len(grades)
    print(f"Média das notas: {media:.2f}")
def ex4():
    vetor = readArray(10)
    t_consoantes, c_lidas = contar_consoantes(vetor)
    print(f'Número de consoantes lidas: {t_consoantes}')
    print('Consoantes lidas:', ', '.join(c_lidas))
def ex5():
    nums = readArrayInt(20)
    even = [n for n in nums if n % 2 == 0]
    odds = [n for n in nums if n % 2 != 0]
    print("Vetor inicial", nums)
    print("Pares:", even)
    print("Impares:", odds)
def ex6():
    grades = readGrades()
    medias = [];
    for i in range(10):
        soma = 0
        for j in grades[i]:
            soma += j
        media =  soma / len(grades[i])
        medias.append(media)
    n_alunos = 0
    for m in medias:
        if m >= 7:
            n_alunos+=1
    print(f"{n_alunos} alunos obtiveram a media maior ou igual à 7")
def ex7():
    nums = readArrayInt(5)
    soma = sum(nums)
    multip = 1
    for i in nums:
        multip *= i
    print(f"Soma dos valores: {soma}")
    print(f"Produto dos valores: {multip}")
def ex8():
    ages, heights = readPersons()
    print(f"Idades: {ages} \nAlturas: {heights[:]}")
welcomeText = """
Bem vindo aos exercícios do aluno Caleb Gomes Pinto 10L
1 - Exercício 1
2 - Exercício 3
4 - Exercício 4
5 - Exercício 5
6 - Exercício 6
7 - Exercício 7
8 - Exercício 8
"""
match int(input(welcomeText)):
    case 1 :
        ex1()
    case 2:
        ex2()
    case 3:
        ex3()
    case 4 :
        ex4()
    case 5:
        ex5()
    case 6:
        ex6()
    case 7 :
        ex7()
    case 8:
        ex8()
    