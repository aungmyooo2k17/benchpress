class Input:

    def input(self, content, type='str'):
        if type is 'str':
            return input(content)

        return type(input(content))
