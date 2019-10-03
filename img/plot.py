import matplotlib.pylab as plt

data = []
with open("../scores.txt") as f:
    for line in f:
        data.append([int(i) for i in line.strip().split(",")])

print(data[-1])

for i,name in enumerate(["gender","handedness","happiness","awakeness"]):
    plot = []
    for row in data[1:]:
        plot.append((row[4*i+1]+row[4*i+3])*100//(row[4*i]+row[4*i+2]))
    plt.plot(range(1,len(plot)+1),plot,"rgbk"[i]+"o-")


plt.xlabel("Predictions made")
plt.ylabel("Correct predictions (%)")
plt.ylim([-3,103])
plt.xlim([1,plt.xlim()[1]])
plt.title("The Bandit's predictions")
plt.legend(["gender","handedness","happiness","awakeness"])

plt.savefig("all.png")
plt.clf()
