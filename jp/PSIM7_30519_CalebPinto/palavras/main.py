def read_words(filename):
    with open(filename, "r") as textFile:
        words = textFile.read().split()
        textFile.close()
    return words


def count_occurences(words):
    occurrences = {}
    for word in words:
        if word not in occurrences:
            occurrences[word] = 0
        occurrences[word] += 1
    return occurrences


def write_occurences(filename, occurrences):
    with open(filename, "w") as outputFile:
        for palavra, contagem in occurrences.items():
            outputFile.write(f"{palavra}: {contagem}\n")
        outputFile.close()


words = read_words("programação.txt")
occurrences = count_occurences(words)
write_occurences("palavras.txt", occurrences)
