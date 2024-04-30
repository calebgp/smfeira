disk_space = 500 * 1024


class User:
    def __init__(self, name, bytes_used):
        self.name = name
        self.bytes = bytes_used


def read_users():
    with open("utilizadores.txt", "r") as user_file:
        users = []
        for line in user_file:
            usr = line.split()
            users.append(User(name=usr[0], bytes_used=usr[1]))
        users = sorted(users, key=lambda u: u.bytes)
        user_file.close()
        return users


def write_users(users_arr):
    with open("relatorio.txt", "w") as summary_file:
        sum_mb = 0
        for user in users_arr:
            usr_mb = int(user.bytes) / 1024
            sum_mb += usr_mb
            summary_file.write(f"{user.name} {usr_mb:.2f} {(usr_mb / disk_space) * 100:.2f}%\n")
        summary_file.write(
            f"MB utilizados: {sum_mb}\nPercentagem do disco utilizado {(sum_mb / disk_space) * 100:.2f}%")


users_list = read_users()
write_users(users_list)
