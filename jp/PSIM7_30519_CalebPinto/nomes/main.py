def read_names(filename):
    with open(filename, "r") as namesFile:
        names = []
        for l in namesFile:
            names.append(l)
        namesFile.close()
    return names


def write_names(names, filename):
    with open(filename, "w") as file:
        for line in names:
            file.write(line)
        file.close()


names = read_names("nomes.txt")
sorted_names = sorted(names)
write_names(sorted_names, "nomes-ordenados.txt")
