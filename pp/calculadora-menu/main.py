def pegar_numeros():
    n1 = int(input('Digite o primeiro valor: '))
    n2 = int(input('Digite o segundo valor: '))
    return n1, n2


def soma(n1, n2):
    return n1 + n2


def subtracao(n1, n2):
    return n1 - n2


def multiplicacao(n1, n2):
    return n1 * n2


def divisao(n1, n2):
    return n1 / n2


def op1():
    n1, n2 = pegar_numeros()
    print(f"O resultado é: {soma(n1, n2):.2f}")


def op2():
    n1, n2 = pegar_numeros()
    print(f"O resultado é: {subtracao(n1, n2):.2f}")


def op3():
    n1, n2 = pegar_numeros()
    print(f"O resultado é: {multiplicacao(n1, n2):.2f}")


def op4():
    n1, n2 = pegar_numeros()
    print(f"O resultado é: {divisao(n1, n2):.2f}")


welcomeMessage = """
Bem-vindo as operações do Caleb
1 - Adição
2 - Subtração
3 - Multiplicação
4 - Divisão
5 - Sair do programa
Escolha uma das opções acima: 
"""
while True:
    match (input(welcomeMessage)):
        case "1":
            op1()
        case "2":
            op2()
        case "3":
            op3()
        case "4":
            op4()
        case "5":
            break
        case _:
            print("Opção inválida escolha outra")
