Este repositório é referente à matéria de Desenvolvimento Web, estou cursando no momento o 3o período de Análise e Desenvolvimento de Sistemas, na UNIPAC.

---

# Desenvolvimento Web

## Installation

### Instalando a biblioteca virtualenv

Para instalar este repositório/documentação em sua máquina, você deverá instalar um ambiente de python no seu path.

Vamos instalar o virtual env.

Windows CMD
```sh
pip install virtualenv
```

Unix shell
```sh
pip3 install virtualenv
```

Para conferir se o virtualenv está instalado você pode executar o comando abaixo:

Windows CMD
```sh
pip list
```

Unix shell
```sh
pip3 list
```

### Criar seu ambiente utilizando VirtualEnv
Agora vamos criar seu ambiente em seu repositório:

> não se esqueça que você deverá estar com seu shell aberto no diretório do projeto.

> disclaimer: para Windows use o comando python, nos sistemas operacionais baseados em Unix: python3

```sh
python3 -m venv venv
```

### Ativar o ambiente

Para ativar o ambiente em seu shell, utilize o comando abaixo:

```sh
source venv/bin/activate
(venv) machine_name %
```