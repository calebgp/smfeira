class Animal:
    def __init__(self, nome, especie):
        self.nome = nome
        self.especie = especie

    def __str__(self):
        return f'{self.nome} - {self.especie}'

    def fazer_som(self, som):
        print(f"{self.nome} faz {som}!")


my_animal = Animal("Thor", "Cachorro")
my_animal.fazer_som("AU AU!")
print(my_animal)

my_animal2 = Animal("Xibiu", "Gato")
my_animal2.fazer_som("MIAUUU!")
print(my_animal2)
