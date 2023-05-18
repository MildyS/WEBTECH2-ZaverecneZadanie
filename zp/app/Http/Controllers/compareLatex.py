import sys
from sympy import *
from sympy.parsing.latex import parse_latex

solution1 = sys.argv[1]
solution2 = sys.argv[2]

eq1 = parse_latex(solution1)
eq2 = parse_latex(solution2)

eq1 = simplify(eq1)
eq2 = simplify(eq2)

print(eq1 == eq2)
