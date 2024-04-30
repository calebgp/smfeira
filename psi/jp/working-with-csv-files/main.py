import csv


def calcular_idade(ano_nascimento):
    from datetime import datetime
    ano_atual = datetime.now().year
    return ano_atual - ano_nascimento


with open('Pessoas.csv', 'r') as arquivo_csv:
    leitor_csv = csv.DictReader(arquivo_csv)
    pessoas = []
    soma_salario = 0
    pessoa_mais_velha = []
    for pessoa in leitor_csv:
        idade = calcular_idade(int(pessoa['DataNascimento']))
        pessoa['Idade'] = idade
        pessoas.append(pessoa)
        soma_salario += float(pessoa['Salario'])

        if not pessoa_mais_velha or idade > pessoa_mais_velha[0]['Idade']:
            pessoa_mais_velha.clear()
            pessoa_mais_velha.append(pessoa)
        elif idade == pessoa_mais_velha[0]['Idade']:
            pessoa_mais_velha.append(pessoa)

    print("Resultados")
    print(f"Soma total de salários: {soma_salario:.2f} €")
    print(f"Pessoa(s) mais velha(s):")
    for pessoa in pessoa_mais_velha:
        print(f"  - {pessoa['Nome']} {pessoa['Apelido']} (Idade: {pessoa['Idade']})")
    with open('Pessoas_com_idades.csv', 'w', newline='') as novo_arquivo_csv:
        escritor_csv = csv.DictWriter(novo_arquivo_csv, fieldnames=leitor_csv.fieldnames + ['Idade'])
        escritor_csv.writeheader()
        for pessoa in pessoas:
            escritor_csv.writerow(pessoa)
