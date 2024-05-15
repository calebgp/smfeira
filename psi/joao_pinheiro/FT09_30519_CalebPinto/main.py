def is_prime(n):
    aux = True
    for i in range(2, int(n ** 0.5) + 1):
        if n % i == 0:
            aux = False
            break
    return aux


def process_data(names, values):
    data = {}
    for i, name in enumerate(names):
        data[name] = values[i]
    media = sum(values) / len(values)
    multiples_5_not_3 = []
    for num in values:
        if num % 5 == 0 and num % 3 != 0:
            multiples_5_not_3.append(num)
    primes = []
    for n in values:
        if n > 1:
            if is_prime(n):
                primes.append(n)
    primes = list(set(primes))
    return {
        "data": data,
        "media": media,
        "multiples_5_not_3": multiples_5_not_3,
        "primes": primes
    }


def main():
    nomes = []
    valores = []
    while True:
        name = input("Digite o name (ou 'sair' para finalizar): ")
        if name.lower() == "sair":
            break
        try:
            value = float(input("Digite o value: "))
        except ValueError:
            print("Valor inválido. Digite um número.")
            continue

        nomes.append(name)
        valores.append(value)
    processed_data = process_data(nomes, valores)
    print("\n## Dados Inseridos")
    print("### Lista:")
    for name, value in processed_data["data"].items():
        print(f"{name}: {value}")
    print("\n### Dicionário:")
    print(processed_data["data"])
    print("\n### Média dos Valores:", processed_data["media"])
    print("\n### Múltiplos de 5 e Não de 3:", processed_data["multiples_5_not_3"])
    print("\n### Números Primos:", processed_data["primes"])
    with open("output.txt", "w") as arquivo:
        arquivo.write(f"## Dados Inseridos\n\n")
        arquivo.write(f"### Lista:\n")
        for name, value in processed_data["data"].items():
            arquivo.write(f"{name}: {value}\n")
        arquivo.write("\n### Dicionário:\n")
        arquivo.write(str(processed_data["data"]))
        arquivo.write("\n\n### Média dos Valores: " + str(processed_data["media"]))
        arquivo.write("\n\n### Múltiplos de 5 e Não de 3: " + str(processed_data["multiples_5_not_3"]))
        arquivo.write("\n\n### Números Primos: " + str(processed_data["primes"]))
    print("\nDados processados e salvos com sucesso!")


if __name__ == "__main__":
    main()
