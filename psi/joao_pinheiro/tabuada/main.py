import keyboard
def tabuada(n):
    for i in range(1,11):
        print(f"{n} X {i} = {n*i}")
num_atual = 1
while True:
    tabuada(num_atual)
    print("Pressione ENTER para visualizar a próxima tabuada ou ESC para parar a execução")
    key_pressed = keyboard.read_event(suppress=True).name
    key_pressed = str(input())
    print(key_pressed)
    if key_pressed == "s":
        num_atual+= 1
        if num_atual > 100:
            num_atual = 1
    elif key_pressed == "esc":
        break
    