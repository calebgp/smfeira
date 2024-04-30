import random

def generate_random_age():
    return random.randint(1, 100)

def main():
    with open('nomes.txt', 'r') as nomes_file, open('sobrenomes.txt', 'r') as sobrenomes_file, open('saida.txt', 'w') as saida_file:
        nomes = nomes_file.read().splitlines()
        sobrenomes = sobrenomes_file.read().splitlines()
        
        for _ in range(int(input("Digite um número N: "))):
            nome = random.choice(nomes)
            sobrenome = random.choice(sobrenomes)
            idade = generate_random_age()
            saida_file.write(f"{nome} {sobrenome} {idade}\n")
        print("Arquivo 'saida.txt' gerado com sucesso!")
if __name__ == "__main__":
    main()