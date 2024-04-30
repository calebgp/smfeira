def read_movies():
    movies = []
    try:
        with open('movies.txt', "r") as movies_file:
            for line in movies_file:
                movie = eval(line)
                movies.append(movie)
    except FileNotFoundError:
        print('No such file or directory')
        pass
    return movies


def save_movies(movies):
    with open("movies.txt", "w") as arquivo:
        for movie in movies:
            arquivo.write(str(movie) + "\n")


def list_movies(movies):
    if not movies:
        print("Não há movies cadastrados.")
    else:
        for i, movie in enumerate(movies):
            print(f"{i + 1}. {movie['title']} ({movie['year']}) - {movie['director']}")


def add_movie(movies):
    title = input("Digite o título do filme: ")
    director = input("Digite o diretor do filme: ")
    year = input("Digite o ano de lançamento do filme: ")
    gender = input("Digite o gênero do filme: ")
    movie = {"title": title, "director": director, "year": year, "gender": gender}
    movies.append(movie)
    save_movies(movies)
    print("movie adicionado com sucesso!")


def delete_movie(movies):
    if not movies:
        print("Não há filmes cadastrados.")
        return
    list_movies(movies)
    indice = int(input("Digite o número do filme a ser excluído: ")) - 1
    if 0 <= indice < len(movies):
        del movies[indice]
        save_movies(movies)
        print("movie excluído com sucesso!")
    else:
        print("Índice inválido.")


def delete_all_movies(movies):
    if not movies:
        print("Não há movies cadastrados.")
        return
    confirmation = input("Deseja realmente excluir todos os movies? (S/N): ")
    if confirmation.upper() == "S":
        backup = movies.copy()
        movies.clear()
        save_movies(movies)
        print("Todos os movies foram excluídos com sucesso.")
        print("Uma cópia de segurança foi criada em 'movies_backup.txt'.")
        with open("movies_backup.txt", "w") as arquivo:
            for movie in backup:
                arquivo.write(str(movie) + "\n")
    else:
        print("Exclusão cancelada.")


def search_movies(movies):
    query = input("Digite o termo de pesquisa (título, diretor, ano ou gênero): ")
    founded_movies = []
    for movie in movies:
        if any(query.lower() in m.lower() for m in movie.values()):
            founded_movies.append(movie)
    if founded_movies:
        print("movies encontrados:")
        list_movies(founded_movies)
    else:
        print("Nenhum movie encontrado.")
menuMessage = """
*** MENU DE FILMES ***
[1] Listar Filmes
[2] Adicionar Filme 
[3] Excluir Filme
[4] Excluir Todos os Filmes
[5] Pesquisar filmes
[6] Sair do programa
"""
while True:
        match (input(menuMessage)):
            case "1":
                movies = read_movies()
                list_movies(movies)
            case "2":
                movies = read_movies()
                add_movie(movies)
            case "3":
                movies = read_movies()
                delete_movie(movies)
            case "4":
                movies = read_movies()
                delete_all_movies(movies)
            case "5":
                movies = read_movies()
                search_movies(movies)
            case _:
                print("Opção inválida escolha outra")