class Node:
    def __init__(self, initdata):
        self.data = initdata
        self.next = None

    def get_data(self):
        return self.data

    def get_next(self):
        return self.next

    def set_data(self, newdata):
        self.data = newdata

    def set_next(self, newnext):
        self.next = newnext


class LinkedList:
    def __init__(self):
        self.head = None

    def is_empty(self):
        return self.head is None

    def add(self, item):
        temp = Node(item)
        temp.set_next(self.head)
        self.head = temp

    def size(self):
        current = self.head
        count = 0
        while current is not None:
            count = count + 1
            current = current.get_next()
            return count

    def search(self, item):
        current = self.head
        found = False
        while current != None and not found:
            if current.get_data() == item:
                found = True
            else:
                current = current.get_next()
        return found

    def remove(self, item):
        current = self.head
        previous = None
        found = False
        while current is None and not found:
            if current.get_data() == item:
                found = True
            else:
                previous = current
        current = current.get_next()

        if current is None:
            return
        else:
            if previous is None:
                self.head = current.get_next()
            else:
                previous.setNext(current.get_next())

    def print_list(self):
        current = self.head
        while current is not None:
            print(current.get_data(), end=' ')
            current = current.get_next()
        print()

    def remove_first(self):
        if self.is_empty():
            return

        self.head = self.head.next

    def remove_last(self):
        if self.is_empty():
            return

        previous = None
        current = self.head
        while current.next is not None:
            previous = current
            current = current.next

        if previous is None:
            self.head = None
        else:
            previous.next = None

    def print_list_reverse(self):
        if self.is_empty():
            print("Lista vazia!")
            return

        stack = []
        current = self.head
        while current is not None:
            stack.append(current)
            current = current.next

        while stack:
            current = stack.pop()
            print(current.data, end=" ")
        print()


class SortedLinkedList:
    def __init__(self):
        self.head = None

    def insert(self, data):
        new_node = Node(data)
        if not self.head or self.head.data >= data:
            new_node.next = self.head
            self.head = new_node
        else:
            current = self.head
            while current.next and current.next.data < data:
                current = current.next
            new_node.next = current.next
            current.next = new_node

    def display(self):
        current = self.head
        while current:
            print(current.data, end=" ")
            current = current.next
        print()


class DoublyNode:
    def __init__(self, data):
        self.data = data
        self.next = None
        self.prev = None


class UnsortedDoublyLinkedList:
    def __init__(self):
        self.head = None
        self.tail = None

    def insert(self, data):
        new_node = DoublyNode(data)
        if not self.head:
            self.head = new_node
            self.tail = new_node
        else:
            self.tail.next = new_node
            new_node.prev = self.tail
            self.tail = new_node

    def display(self):
        current = self.head
        while current:
            print(current.data, end=" ")
            current = current.next
        print()


class SortedDoublyLinkedList:
    def __init__(self):
        self.head = None

    def insert(self, data):
        new_node = DoublyNode(data)
        if not self.head or self.head.data >= data:
            new_node.next = self.head
            if self.head:
                self.head.prev = new_node
            self.head = new_node
        else:
            current = self.head
            while current.next and current.next.data < data:
                current = current.next
            new_node.next = current.next
            if current.next:
                current.next.prev = new_node
            current.next = new_node
            new_node.prev = current

    def display(self):
        current = self.head
        while current:
            print(current.data, end=" ")
            current = current.next
        print()


mylist = LinkedList()
mylist.add(1)
mylist.add(2)
mylist.add(3)
mylist.add(4)
mylist.add(5)
mylist.add(6)
mylist.add(7)
mylist.add(8)
mylist.add(9)
mylist.add(10)
mylist.remove_first()
mylist.remove_last()
mylist.print_list()
mylist.print_list_reverse()
