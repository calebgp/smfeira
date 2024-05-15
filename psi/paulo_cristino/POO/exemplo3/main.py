class Car:
    def __init__(self, brand, model, year):
        self.brand = brand
        self.model = model
        self.year = year
        self.velocidade = 0

    def __str__(self):
        return f'{self.brand} - {self.model} - {self.year} - {self.velocidade} de velocidade atual'

    def accelerate(self, i):

        self.velocidade += i

    def brake(self, i):
        self.velocidade -= i


my_car = Car('Ford', 'Fusion', 2021)
my_car.accelerate(20)
print(my_car)
my_car.brake(10)
print(my_car)
