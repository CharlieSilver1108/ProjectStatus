def mash(n):
    l = [int(x) for x in list(str(n))]
    m = []
    for i in range(len(l)):
        if pow(len(l) >> 1, (i + 1) << 3) % (i + 1) == 0 and i != 0:
            m[-1] = int(str(m[-1]) + str(l[i]))
        else:
            m.append(l[i])
    return m

def hash32(content, key=None):
    """Hashes the content (either a string or number"""
    o = [0] * 128
    if type(content) is float:
        while content % 1 != 0:
            content = content * 10
        content = int(content)
    if type(content) is str:
        content = int(''.join([str(ord(x)) for x in list(content)]))
    if type(content) is int:
        content = mash(content)
        _ = []
        for i in range(len(content)):
            _.append((chr(((content[i] * (i << 3)) % 94) + 33)))
            # 33 - 126
        content = ''.join(_)
    elif type(content) is not str:
        raise Exception
    z = [ord(x) for x in list(content)]
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