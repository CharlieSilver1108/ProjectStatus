def hash32(content, key=None):
    """Hashes the content (either a string or number)"""
    o = [0] * 32
    if type(content) is float:
        while content % 1 != 0:
            content = content * 10
        content = int(content)
        content = str(content)
    if type(content) is int:
        content = str(content)
    if type(content) is str:
        content = int(''.join([str(ord(x)) for x in list(content)]))
    elif type(content) is not str:
        raise Exception
    print (content)
    content = [str(y) for y in str(content)]
    print(content)
    z = [ord(x) for x in content]
    print (z)
    
    for i in range(len(z)):
        if z[i] % 2 == 0:
            n = next((i for i, x in enumerate(o) if not x and i % 2 == 0), 0)
        else:
            n = next((i for i, x in enumerate(o) if not x and i % 2 == 1), 0)
        o[n] = content[i]
    o = [str(x) for x in o]
    o.reverse()
    init_n = o.count('0')
    while o.count('0') > 5:
        n = next((i for i, x in enumerate(o) if x == '0'), None)
        o[n] = chr(((pow(init_n >> 1, o.count('0'))) % 94) + 33)
    o.reverse()
    return ''.join(o)
