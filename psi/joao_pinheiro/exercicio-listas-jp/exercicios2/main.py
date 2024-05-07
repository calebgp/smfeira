def contar_consoantes(vetor):
    consoantes = 'bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ'
    t_consoantes = 0
    c_lidas = []

    for char in vetor:
        if char in consoantes:
            t_consoantes += 1
            c_lidas.append(char)

    return t_consoantes, c_lidas

def readStudents():
    ages = [];
    heights = []
    for i in range(30):
        print(f"\nAluno {i + 1}\n")
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
def getMonth(i):
    match i:
        case 1:
            return "Janeiro"
        case 2:
            return "Fevereiro"
        case 3:
            return "Março"
        case 4:
            return "Abril"
        case 5:
            return "Maio"
        case 6:
            return "Junho"
        case 7:
            return "Julho"
        case 8:
            return "Agosto"
        case 9:
            return "Setembro"
        case 10:
            return "Outubro"
        case 11:
            return "Novembro"
        case 12:
            return "Dezembro"
        case _:
            return ""
def readYear():
    temps = []
    for month in range(1, 13):
        temp= float(input(f"Informe a temperatura média do mês {getMonth(month)}: "))
        temps.append(temp)

    
    return temps
def readArrayFloat(i):
    v = [0] * i
    for i in range(i):
        v[i] = float(input(f"Digite o {i+1} numero do vetor: "))
    return v
def readQuestionAnswers():
    print("Digite 1 pra sim e 0 para não")
    questions = [
        "Telefonou para a vítima? ",
        "Esteve no local do crime? ",
        "Mora perto da vítima? ",
        "Devia para a vítima? ",
        "Já trabalhou com a vitíma? "
    ]
    answers = []
    for question in questions:
        answers.append(int(input(question)))
    return answers

def ex1():
    nums = readArrayInt(10)
    sum_squares = 0
    for n in nums:
        sum_squares += (n**2)
    print(f"A soma dos quadrados do vetor é: {sum_squares}")
def ex2():
    nums1 = readArrayInt(10)
    nums2 = readArrayInt(10)

    nums = []
    for i in range(10):
        nums.append(nums1[i])
        nums.append(nums2[i])
    print(f"Vetor intercalado: {nums}")
    
def ex3():
    nums1 = readArrayInt(10)
    nums2 = readArrayInt(10)
    nums3 = readArrayInt(10)
    nums = []
    for i in range(10):
        nums.append(nums1[i])
        nums.append(nums2[i])
        nums.append(nums3[i])
    print(f"Vetor intercalado: {nums}")
def ex4():
    ages, heights = readStudents()
    media = sum(heights) / len(heights)
    cont = 0
    for i in range(30):
        if ages[i] > 13 and heights[i] < media:
            cont += 1
    print(f"Quantidade de alunos com mais de 13 anos e altura inferior à média: {cont}")
def ex5():
    temps = readYear()
    media = sum(temps) / len(temps)

    
    print(f"\nAs temps acima da média anual ({media:.2f}) são:")
    for i, temp in enumerate(temps):
        if temp > media:
            print(f"{getMonth(i+1)}: {temp:.2f}")
def ex6():
    answs = readQuestionAnswers()
    c = 0
    for a in answs:
        if a == 1:
            c +=1
    if c == 2:
        print("Suspeita")
    elif c == 3 or c == 4:
        print("Cúmplice")
    elif c == 5:
        print("Assasino")

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
    print(f"ages: {ages} \nAlturas: {heights[:]}")
welcomeText = """
Bem vindo aos exercícios do aluno Caleb Gomonth Pinto 10L
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
    