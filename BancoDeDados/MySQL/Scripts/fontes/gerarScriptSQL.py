import random as r
import calendar as c

def criarInsertPaciente():
    SQL = "USE trabalho;"
    i = 1
    professores = file('professoresC3.txt','r')
    sqlFile = file('result.sql', 'w+')
    prof = professores.readline()
    while (prof != ""):
        prof = prof.replace("\n","")
        prof = prof.replace("'","")
        x = r.randint(0,7)
        if(x == 0): tipoSanguineo = "O+"
        if(x == 1): tipoSanguineo = "A+"
        if(x == 2): tipoSanguineo = "B+"
        if(x == 3): tipoSanguineo = "AB+"
        if(x == 4): tipoSanguineo = "AB-"
        if(x == 5): tipoSanguineo = "B-"
        if(x == 6): tipoSanguineo = "A-"
        if(x == 7): tipoSanguineo = "O-"
        x = r.randint(0,3)
        if(x == 0): planoDeSaude = "Standard"
        if(x == 1): planoDeSaude = "Executive"
        if(x == 2): planoDeSaude = "Master"
        if(x == 3): planoDeSaude = "Platinum"
        SQL = SQL + "\nINSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, '"+str(prof)+"', '1234567', '"+str(r.randint(3000000000,39999999999)).zfill(11)+"','"+planoDeSaude+"', '"+str()+"', '"+tipoSanguineo+"', '"+str(r.randint(1970,1990))+"-"+str(r.randint(1,12)).zfill(2)+"-"+str(r.randint(1,27)).zfill(2)+"', 'Rua "+str(i)+", "+str(r.randint(0,9999))+"', '"+str(r.randint(90000000,99999999))+"', '+55 "+str(r.randint(53,54))+" 3233 "+str(r.randint(1000,9999))+"', '+55 "+str(r.randint(53,54))+" "+str(r.randint(9000,9999))+" "+str(r.randint(9000,9999))+"', '"+str(str(prof).partition(" ")[0]).lower()+"@furg.br', CURRENT_TIMESTAMP);"
        criarClinicaPaciente(i)
        i = i+1
        prof = professores.readline()
    professores.close()
    sqlFile.write(SQL)
    sqlFile.close()
    return SQL

def criarInsertMedico():
    SQL = "USE trabalho;"
    i = 1
    medicos = file('medicos.txt','r')
    sqlFile = file('result.sql', 'w+')
    med = medicos.readline()
    while (med != ""):
        med = med.replace("\n","")
        x = r.randint(0,7)
        if(x == 0): email = "gmail"
        if(x == 1): email = "hotmail"
        if(x == 2): email = "outlook"
        if(x == 3): email = "yahoo"
        if(x == 4): email = "apple"
        if(x == 5): email = "medic"
        if(x == 6): email = "heaven"
        if(x == 7): email = "email"
        x = r.randint(0,3)
        if(x == 0): planoDeSaude = "Standard"
        if(x == 1): planoDeSaude = "Executive"
        if(x == 2): planoDeSaude = "Master"
        if(x == 3): planoDeSaude = "Platinum"
        SQL = SQL + "\nINSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, '"+str(med)+"', '1234567', '"+str(r.randint(4000000000,49999999999)).zfill(11)+"','"+planoDeSaude+"', '"+str(r.randint(1970,1990))+"-"+str(r.randint(1,12)).zfill(2)+"-"+str(r.randint(1,27)).zfill(2)+"', 'Rua "+str(i)+", "+str(r.randint(0,9999))+"', '"+str(r.randint(90000000,99999999))+"', '+55 "+str(r.randint(53,54))+" 3233 "+str(r.randint(1000,9999))+"', '+55 "+str(r.randint(53,54))+" "+str(r.randint(9000,9999))+" "+str(r.randint(9000,9999))+"', '"+str(str(med).partition(" ")[0]).lower()+"@"+email+".com', CURRENT_TIMESTAMP);"
        criarClinicaMedico(i)
        criarInsertMedicoEspecialidade(i)
        criarInsertHorarioAtendimento(i)
        i = i+1
        med = medicos.readline()
    medicos.close()
    sqlFile.write(SQL)
    sqlFile.close()
    return SQL

def criarInsertHorarioAtendimento(codMedico):
    SQL = ""
    sqlFile = file('result2.sql', 'a+')
    seg = "0000000000000000000000"
    ter = "0000000000000000000000"
    qua = "0000000000000000000000"
    qui = "0000000000000000000000"
    sex = "0000000000000000000000"
    for i in range(3): # trabalha apenas 4 dias
        x = r.randint(1,5)
        if(x == 1): seg = horario(seg)
        if(x == 2): ter = horario(ter)
        if(x == 3): qua = horario(qua)
        if(x == 4): qui = horario(qui)
        if(x == 5): sex = horario(sex)
    x = r.randint(1,3)
    if(x == 1): codClinica = "1"
    if(x == 2): codClinica = "2"
    if(x == 3): codClinica = "3"
    
    SQL = SQL + "\nINSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '"+str(codMedico)+"', '"+codClinica+"', '"+seg+"', '"+ter+"', '"+qua+"', '"+qui+"', '"+sex+"');"
    
    prob = r.random()
    if(prob>0.5):
        while(str(x)== codClinica):
            x = r.randint(1,3)
        if(x == 1): codClinica = "1"
        if(x == 2): codClinica = "2"
        if(x == 3): codClinica = "3"
        seg.replace("1","X")
        ter.replace("1","X")
        qua.replace("1","X")
        qui.replace("1","X")
        sex.replace("1","X")
        for i in range(3): # trabalha apenas 4 dias
            x = r.randint(1,5)
            if(x == 1): seg = horario(seg)
            if(x == 2): ter = horario(ter)
            if(x == 3): qua = horario(qua)
            if(x == 4): qui = horario(qui)
            if(x == 5): sex = horario(sex)
        
        
        SQL = SQL + "\nINSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '"+str(codMedico)+"', '"+codClinica+"', '"+seg+"', '"+ter+"', '"+qua+"', '"+qui+"', '"+sex+"');"
    
    sqlFile.write(SQL)
    sqlFile.close()
    return SQL

def horario(diaSemana):
    h = ""
    for i in range(22):
        if(diaSemana[i] != "X"):
            h = h + str(r.randint(0,1))
    return h

def criarInsertEspecialidade():
    SQL = "USE trabalho;"
    i = 1
    especialidades = file('especialidades.txt','r')
    sqlFile = file('result3.sql', 'w+')
    esp = especialidades.readline()
    while (esp != ""):
        esp = str(esp).rsplit(":")
        
        SQL = SQL + "\nINSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, '"+str(esp[0])+"', '"+str(esp[1])+"');"
        esp = especialidades.readline()
    especialidades.close()
    sqlFile.write(SQL)
    sqlFile.close()
    return SQL

def criarInsertMedicoEspecialidade(codMedico):
    SQL = ""
    sqlFile = file('result4.sql', 'a+')
    prob = r.randint(1,2) # pode ter ate 3 especialidades (0, 1) ou (0, 1, 2)
    for i in range(0,prob): 
        esp = r.randint(1,55)
        SQL = SQL + "\nINSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '"+str(codMedico)+"', '"+str(esp)+"');"
    sqlFile.write(SQL)
    sqlFile.close()
    return SQL

def criarClinicaMedico(codMedico):
    SQL = ""
    sqlFile = file('result5.sql', 'a+')
    prob = r.randint(1,2) # pode atuar em ate 3 clinicas (0, 1) ou (0, 1, 2)
    for i in range(0,prob): 
        clinica = r.randint(1,3)
        SQL = SQL + "\nINSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '"+str(clinica)+"', '"+str(codMedico)+"');"
    sqlFile.write(SQL)
    sqlFile.close()
    return SQL

def criarClinicaPaciente(codPaciente):
    SQL = ""
    sqlFile = file('result5.sql', 'a+')
    prob = r.randint(1,2) # pode utilizar em ate 3 clinicas (todas) (0, 1) ou (0, 1, 2)
    for i in range(0,prob): 
        clinica = r.randint(1,3)
        SQL = SQL + "\nINSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '"+str(clinica)+"', '"+str(codPaciente)+"');"
    sqlFile.write(SQL)
    sqlFile.close()
    return SQL





def main():
    # print(criarInsertMedico())
    print(criarInsertPaciente())
    # print(criarInsertEspecialidade())



main()