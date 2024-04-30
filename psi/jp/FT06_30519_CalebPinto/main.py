class Response:
    def __init__(self, gender, age, response_zombie, response_vegan):
        self.gender = gender
        self.age = int(age)
        if response_zombie == "S":
            self.is_zombie = True
        else:
            self.is_zombie = False
        if response_vegan == "S":
            self.is_vegan = True
        else:
            self.is_vegan = False

    def __str__(self):
        return f'gender: {self.gender}, age: {self.age}, is_zombie: {self.is_zombie}, is_vegan: {self.is_vegan}\n'


def get_responses(filename):
    arr = []
    with open(filename, "r") as f:
        for line in f:
            response = Response(*line.split(","))
            arr.append(response)
            print(response)
        f.close()
    return arr


def calc_n_zombies(arr):
    n_zombies = 0
    for response in arr:
        if response.is_zombie:
            n_zombies += 1
    return n_zombies


def calc_n_mans_non_zombified_age_less_than_40(arr):
    n_mans_non_zombified = 0
    for response in arr:
        if not response.is_zombie:
            if response.age < 40:
                n_mans_non_zombified += 1


responses = get_responses("questionario.txt")
print(
    f"Percentual de zumbis em relação ao número total de pessoas entrevistadas: {(calc_n_zombies(responses) / len(responses)) * 100:.2f}%\n")
print(f"Percentual de homens não zumbificados abaixo de 40 anos em relação ao número total de homens entrevistados: {calc_n_zombies(responses) / len(responses):.2f}%\n")
