class Animal:
    def __init__(self, nome, especie):
        self.nome = nome
        self.especie = especie

    def __str__(self):
        return f'{self.nome} - {self.especie}'


my_animal = Animal("Thor", "Cachorro")
print(my_animal)

my_animal2 = Animal("Xibiu", "Gato")
print(my_animal2)
