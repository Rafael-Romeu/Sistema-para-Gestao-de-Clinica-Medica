####### Criacao do Database: trabalho #######

CREATE DATABASE trabalho CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

####### tConsulta #######

CREATE TABLE `trabalho`.`tConsulta` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`codClinica` INT NOT NULL DEFAULT 0, 
	`codAtendente` INT NOT NULL DEFAULT 0,
	`codMedico` INT NOT NULL DEFAULT 0, 
	`codPaciente` INT NOT NULL DEFAULT 0, 
	`flagConfirmada` TINYINT(1) NOT NULL DEFAULT 0, 
	`data` DATE, 
	`hora` VARCHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`observacao` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`receita` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`regDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
	PRIMARY KEY (`codigo`))
	ENGINE = InnoDB;
CREATE UNIQUE INDEX `chave`
ON `trabalho`.`tConsulta`(`codClinica`, `codMedico` , `codPaciente` , `data`, `hora`);


####### tClinica #######

CREATE TABLE `trabalho`.`tClinica` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`nome` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`cnpj` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`endereco` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`CEP` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone1` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone2` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`regDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
	`corPrimaria` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`corSucesso` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`corFalha` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  
	`cor1` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  
	`cor2` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  
	`cor3` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  
	`cor4` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',  
	`cor5` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	PRIMARY KEY (`codigo`),
	UNIQUE `cnpj` (`cnpj`))
	ENGINE = InnoDB;


####### tAtendente #######

CREATE TABLE `trabalho`.`tAtendente` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`nome` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`senha` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	`cpf` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	`dataNascimento` DATE,
	`endereco` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`CEP` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone1` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone2` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`regDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
	PRIMARY KEY (`codigo`),
	UNIQUE `cpf` (`cpf`)) 
	ENGINE = InnoDB;


####### tMedico #######

CREATE TABLE `trabalho`.`tMedico` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`nome` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`senha` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`cpf` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`planoDeSaude` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`dataNascimento` DATE, 
	`endereco` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`CEP` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone1` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone2` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`regDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`codigo`),
	UNIQUE `cpf` (`cpf`)) 
	ENGINE = InnoDB;
							

###### tPaciente #######

CREATE TABLE `trabalho`.`tPaciente` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`nome` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`senha` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`cpf` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`planoDeSaude` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`genero` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`tipoSanguineo` VARCHAR(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`dataNascimento` DATE, 
	`endereco` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`CEP` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone1` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone2` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`regDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`codigo`),
	UNIQUE `cpf` (`cpf`)) 
	ENGINE = InnoDB;
							
							
####### tClinicaAtendente #######

CREATE TABLE `trabalho`.`tClinicaAtendente` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`codClinica` INT NOT NULL DEFAULT 0, 
	`codAtendente` INT NOT NULL DEFAULT 0, 
	PRIMARY KEY (`codigo`)) 
	ENGINE = InnoDB;
CREATE UNIQUE INDEX `chave`
ON `trabalho`.`tClinicaAtendente`(`codClinica`, `codAtendente`);


####### tClinicaMedico #######

CREATE TABLE `trabalho`.`tClinicaMedico` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`codClinica` INT NOT NULL DEFAULT 0, 
	`codMedico` INT NOT NULL DEFAULT 0, 
	PRIMARY KEY (`codigo`)) 
	ENGINE = InnoDB;
CREATE UNIQUE INDEX `chave`
ON `trabalho`.`tClinicaMedico`(`codClinica`, `codMedico`);


####### tClinicaPaciente #######

CREATE TABLE `trabalho`.`tClinicaPaciente` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`codClinica` INT NOT NULL DEFAULT 0, 
	`codPaciente` INT NOT NULL DEFAULT 0, 
	PRIMARY KEY (`codigo`)) 
	ENGINE = InnoDB;
CREATE UNIQUE INDEX `chave`
ON `trabalho`.`tClinicaPaciente`(`codClinica`, `codPaciente`);


####### tHorarioAtendimento #######

CREATE TABLE `trabalho`.`tHorarioAtendimento` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`codMedico` INT NOT NULL DEFAULT 0, 
	`codClinica` INT NOT NULL DEFAULT 0, 
	`seg` VARCHAR(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`ter` VARCHAR(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`qua` VARCHAR(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`qui` VARCHAR(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`sex` VARCHAR(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	PRIMARY KEY (`codigo`)) 
	ENGINE = InnoDB;

CREATE UNIQUE INDEX `chave`
ON `trabalho`.`tHorarioAtendimento`(`codMedico`, `codClinica`);
	

####### tEspecialidade #######

CREATE TABLE `trabalho`.`tEspecialidade` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`nome` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`descricao` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	PRIMARY KEY (`codigo`),
	UNIQUE (`nome`))
	ENGINE = InnoDB;
	

####### tMedicoEspecialidade #######

CREATE TABLE `trabalho`.`tMedicoEspecialidade` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`codMedico` INT NOT NULL DEFAULT 0, 
	`codEspecialidade` INT NOT NULL DEFAULT 0, 
	PRIMARY KEY (`codigo`)) 
	ENGINE = InnoDB;

CREATE UNIQUE INDEX `chave`
ON `trabalho`.`tMedicoEspecialidade`(`codMedico`, `codEspecialidade`);
	
	

####### INSERCOES #######

####### tClinica #######

USE trabalho;
INSERT INTO `tClinica` (`codigo`, `nome`, `cnpj`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`, `corPrimaria`,`corSucesso`,`corFalha`,`cor1`,`cor2`,`cor3`,`cor4`,`cor5`) VALUES (NULL, 'Mayo CLinic', '77777777777777717', '1216 Second Street SW Rochester, MN, US', '55902', '+1 (507) 405-0312', '', 'www.mayoclinic.org', CURRENT_TIMESTAMP, 'hsl(208, 100%, 46%)','hsl(100, 100%, 75%)','rgb(255, 134, 134)','hsl(0, 0%, 10%)','hsl(0, 0%, 30%)','hsl(0, 0%, 80%)','hsl(0, 0%, 97%)','hsl(0, 0%, 100%)');
INSERT INTO `tClinica` (`codigo`, `nome`, `cnpj`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`, `corPrimaria`,`corSucesso`,`corFalha`,`cor1`,`cor2`,`cor3`,`cor4`,`cor5`) VALUES (NULL, 'Grey Sloan Memorial Hospital', '77777777777777718', '15000 Centennial Drive Seattle, Washington, US', '98109', '+1 (206) 555-6000', '', 'http://greysanatomy.wikia.com/wiki/Grey_Sloan_Memorial_Hospital', CURRENT_TIMESTAMP, '#eaba2a','#0b5010','#500b0b','hsl(0, 0%, 95%)','hsl(0, 0%, 90%)','hsl(0, 0%, 50%)','hsl(0, 0%, 30%)','hsl(0, 0%, 10%)');
INSERT INTO `tClinica` (`codigo`, `nome`, `cnpj`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`, `corPrimaria`,`corSucesso`,`corFalha`,`cor1`,`cor2`,`cor3`,`cor4`,`cor5`) VALUES (NULL, 'Princeton Teaching Hospital', '77777777777777719', 'Princeton, NJ, US', '08544', '+1 (609) 258-3000', '', 'http://house.wikia.com/wiki/Princeton-Plainsboro_Teaching_Hospital', CURRENT_TIMESTAMP, 'hsla(209, 29%, 40%, 1)','hsl(100, 100%, 75%)','rgb(255, 134, 134)','hsl(0, 0%, 10%)','hsl(0, 0%, 30%)','hsl(0, 0%, 80%)','hsla(209, 86%, 90%, 1)','hsl(0, 0%, 100%)');

####### tAtendente #######

USE trabalho;
INSERT INTO `tAtendente` (`codigo`, `nome`, `senha`, `cpf`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (
	NULL, 
	'Marlon Rubio de Carvalho Franco', 
	'1234567', 
	'77777777777', 
	'1993-05-31', 
	'Rua da minha casa, 333, apto 201', 
	'77777777', 
	'+55 53 7787 7777', 
	'', 
	'marlon@scadiagro.com.br', 
	CURRENT_TIMESTAMP);
INSERT INTO `tAtendente` (`codigo`, `nome`, `senha`, `cpf`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (
	NULL, 
	'Rafael Monteiro Bulsing', 
	'1234567', 
	'55555555555', 
	'1996-06-23', 
	'Rua da casa do Bulsing, 555, apto 999', 
	'96200100', 
	'+55 53 5555 7777', 
	'', 
	'rafaelbulsingfurg@gmail.com', 
	CURRENT_TIMESTAMP);
INSERT INTO `tAtendente` (`codigo`, `nome`, `senha`, `cpf`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (
	NULL, 
	'Rafael Neves Romeu', 
	'1234567', 
	'88888888888', 
	'1994-04-10', 
	'Rua da casa do Romeu, 444, apto 4444', 
	'97200150', 
	'+55 53 4444 7777', 
	'', 
	'rafaelromeufurg@gmail.com', 
	CURRENT_TIMESTAMP);
	
####### tPaciente #######

USE trabalho;
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ANDRE LUIS CASTRO DE FREITAS', '1234567', '07823704333','Platinum', '', 'O+', '1988-06-12', 'Rua 1, 7894', '97776080', '+55 54 3233 3636', '+55 53 9982 9688', 'andre@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SILVIA SILVA DA COSTA BOTELHO', '1234567', '22906311945','Master', '', 'B+', '1990-04-18', 'Rua 3, 2871', '97305061', '+55 54 3233 4234', '+55 54 9350 9440', 'silvia@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SEBASTIAO CICERO PINHEIRO GOMES', '1234567', '13352874137','Standard', '', 'O-', '1984-07-17', 'Rua 4, 3557', '99847247', '+55 53 3233 5172', '+55 53 9117 9484', 'sebastiao@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'PEDRO RICARDO DEL SANTORO', '1234567', '23480292942','Standard', '', 'B+', '1983-10-01', 'Rua 7, 7429', '99032010', '+55 53 3233 1367', '+55 53 9967 9917', 'pedro@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ALESSANDRO DE LIMA BICHO', '1234567', '16790329820','Platinum', '', 'B+', '1987-10-26', 'Rua 8, 3927', '91704827', '+55 53 3233 3210', '+55 53 9300 9772', 'alessandro@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'VITOR IRIGON GERVINI', '1234567', '14682921845','Standard', '', 'A-', '1977-07-02', 'Rua 9, 938', '95507639', '+55 53 3233 9999', '+55 53 9800 9639', 'vitor@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'EWERSON LUIZ DE SOUZA CARVALHO', '1234567', '03354277540','Standard', '', 'B+', '1989-04-24', 'Rua 16, 5439', '93319043', '+55 54 3233 7260', '+55 54 9092 9168', 'ewerson@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DIANA FRANCISCA ADAMATTI', '1234567', '08004664883','Executive', '', 'O+', '1987-03-15', 'Rua 17, 1152', '90425734', '+55 54 3233 8159', '+55 54 9778 9865', 'diana@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'REGINA BARWALDT', '1234567', '27462866302','Master', '', 'O-', '1973-04-01', 'Rua 19, 8951', '92180751', '+55 53 3233 6334', '+55 54 9155 9610', 'regina@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'MARCELO RITA PIAS', '1234567', '26804566799','Executive', '', 'B+', '1979-11-11', 'Rua 24, 4483', '94624477', '+55 53 3233 4974', '+55 54 9430 9515', 'marcelo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CLEO ZANELLA BILLA', '1234567', '30904687559','Executive', '', 'O+', '1984-08-23', 'Rua 25, 2506', '99913923', '+55 54 3233 1185', '+55 53 9912 9404', 'cleo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ODORICO MACHADO MENDIZABAL', '1234567', '39411236142','Platinum', '', 'B+', '1977-10-06', 'Rua 28, 2528', '99881879', '+55 53 3233 2192', '+55 54 9684 9768', 'odorico@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'PAULO FRANCISCO BUTZEN', '1234567', '18683582437','Standard', '', 'AB+', '1972-07-14', 'Rua 29, 7781', '95848986', '+55 53 3233 7560', '+55 54 9681 9956', 'paulo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'KARINA DOS SANTOS MACHADO', '1234567', '18435437908','Master', '', 'A-', '1974-02-18', 'Rua 30, 4795', '90601082', '+55 54 3233 4067', '+55 54 9845 9075', 'karina@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'RODRIGO ROCHA DAVESAC', '1234567', '20530629973','Standard', '', 'O-', '1984-11-18', 'Rua 35, 3173', '90324474', '+55 54 3233 1399', '+55 53 9867 9159', 'rodrigo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DENALIZE GOULART LEITE', '1234567', '33966438873','Master', '', 'A+', '1972-05-08', 'Rua 38, 2406', '96069311', '+55 54 3233 2410', '+55 53 9929 9786', 'denalize@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JUSOAN LANG MOR', '1234567', '25528675580','Platinum', '', 'B-', '1978-06-07', 'Rua 42, 9273', '98375474', '+55 54 3233 6212', '+55 54 9249 9986', 'jusoan@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ANDRE PRISCO VARGAS', '1234567', '26972651304','Executive', '', 'AB-', '1990-02-06', 'Rua 48, 5860', '92472875', '+55 54 3233 4986', '+55 54 9830 9036', 'andre@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CRISTINA MEINHARDT', '1234567', '20384979598','Executive', '', 'AB+', '1977-11-02', 'Rua 50, 4488', '90789830', '+55 53 3233 2596', '+55 54 9600 9443', 'cristina@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'RAFAEL AUGUSTO PENNA DOS SANTOS', '1234567', '15276936682','Platinum', '', 'O-', '1978-02-26', 'Rua 52, 6019', '97826615', '+55 53 3233 7146', '+55 54 9083 9393', 'rafael@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'RICARDO NAGEL RODRIGUES', '1234567', '27194767671','Platinum', '', 'AB-', '1987-10-01', 'Rua 54, 2094', '97451050', '+55 53 3233 5546', '+55 54 9036 9444', 'ricardo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ADILSON AROCHA PEDROSO', '1234567', '26069813289','Executive', '', 'B-', '1988-07-18', 'Rua 56, 8846', '91800206', '+55 54 3233 5123', '+55 53 9216 9659', 'adilson@furg.br', CURRENT_TIMESTAMP);


####### tMedico #######

USE trabalho;

INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOCTOR ZOIDBERG', '1234567', '15306911651','Master', '1986-10-09', 'Rua 13, 7232', '93200897', '+55 53 3233 5726', '+55 54 9263 9617', 'doctor@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOUTOR ESTRANHO', '1234567', '42519743453','Master', '1979-09-26', 'Rua 17, 6137', '96022935', '+55 53 3233 4134', '+55 53 9640 9255', 'doutor@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOUTORA BRINQUEDOS', '1234567', '05899704028','Master', '1982-04-25', 'Rua 19, 654', '91370249', '+55 54 3233 5668', '+55 53 9075 9541', 'doutora@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'FU MANCHU', '1234567', '16786257916','Master', '1972-01-12', 'Rua 23, 8393', '92352616', '+55 53 3233 8861', '+55 54 9434 9253', 'fu@gmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DR. JULIUS HIBBERT', '1234567', '31620068466','Platinum', '1970-05-05', 'Rua 27, 1555', '97306786', '+55 54 3233 6842', '+55 53 9495 9936', 'dr.@apple.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'GREGORY HOUSE', '1234567', '42376015444','Standard', '1973-06-25', 'Rua 28, 8337', '92204464', '+55 54 3233 1174', '+55 54 9833 9281', 'gregory@outlook.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JOHN DORIAN', '1234567', '42832412046','Executive', '1982-03-21', 'Rua 29, 5005', '96627344', '+55 54 3233 6827', '+55 54 9427 9259', 'john@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DR. MARIO', '1234567', '04325650120','Platinum', '1977-02-11', 'Rua 38, 612', '97559803', '+55 53 3233 3335', '+55 53 9771 9130', 'mario@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'MEREDITH GREY', '1234567', '36565784015','Standard', '1985-01-12', 'Rua 42, 8136', '94324672', '+55 53 3233 2663', '+55 54 9610 9122', 'meredith@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SAKURA HARUNO', '1234567', '11954496659','Executive', '1975-09-15', 'Rua 52, 8804', '94524840', '+55 53 3233 9686', '+55 53 9878 9790', 'sakura@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'THIRTEEN', '1234567', '12318530577','Platinum', '1975-05-13', 'Rua 62, 5881', '98648179', '+55 53 3233 7599', '+55 54 9297 9269', 'thirteen@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JAMES WILSON', '1234567', '38146772554','Platinum', '1980-11-07', 'Rua 63, 4614', '94976355', '+55 53 3233 9692', '+55 54 9350 9318', 'james@heaven.com', CURRENT_TIMESTAMP);



####### tHorarioAtendimento #######

USE trabalho;

INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '1', '1', '1111111111111111111111', '1111111111111111111111', '1111111111100000000000', '1111111111100000000000', '1111111111111111111111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '1', '2', '0000000000000000000000', '0000000000000000000000', '0000000000011111111111', '0000000000011111111111', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '2', '2', '0111011101000100101110', '0000000000000000000000', '1001111100111010000011', '1111101010111010011101', '0011001101111001001100');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '3', '3', '0000000000000000000000', '1111111111111111111111', '0000000000000000000000', '0000000000000000000000', '1111111111111111111111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '3', '1', '1111111111111111111111', '0000000000000000000000', '1111111111111111111111', '1111111111111111111111', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '4', '2', '0111010111100110011000', '0000000000000000000000', '0000000000000000000000', '0100001010111011010101', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '5', '2', '1111111111111111111111', '1111111111111111111111', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '5', '3', '0000000000000000000000', '0000000000000000000000', '1111111111111111111111', '1111111111111111111111', '1111111111111111111111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '6', '1', '1010101001000011100100', '0011001001000110100100', '0000000000000000000000', '0000000000000000000000', '0110110001111101100000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '7', '2', '0000000000000000000000', '0000000000000000000000', '0100111111010100000101', '1100110100000010011011', '0010110001000101001001');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '8', '2', '0000000000000000000000', '0000000000000000000000', '1111111111111111111111', '1111111111111111111111', '1111111111111111111111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '8', '3', '1001010100011100111011', '1111111111111111111111', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '9', '2', '0000000000000000000000', '1100101100010101000101', '0000000000000000000000', '0000000000000000000000', '0001010110000100010010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '10', '3', '1111001011101101010101', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '0011111011000101011010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '10', '1', '0000000000000000000000', '0000000000000000000000', '1111110000100001111001', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '11', '1', '0000110011000111101000', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '12', '2', '0000000000000000000000', '0101100101110100010000', '0000000000000000000000', '0000000000000000000000', '1111110100111100000110');


####### tEspecialidade #######

USE trabalho;
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Acupuntura', ' ramo da medicina tradicional chinesa e um método de tratamento chamado complementar de acordo com a nova terminologia da OMS.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Alergia e Imunologia', ' diagnóstico e tratamento das doenças alérgicas e do sistema imunológico.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Anestesiologia', ' área da Medicina que envolve o tratamento da dor, a hipnose e o manejo intensivo do paciente sob intervenção cirúrgica ou procedimentos.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Angiologia', ' é a área da medicina que estuda o tratamento das doenças do aparelho circulatório.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cancerologia (oncologia)', ' é a especialidade que trata dos tumores malignos ou câncer.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cardiologia', ' aborda as doenças relacionadas com o coração e sistema vascular.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cirurgia Cardiovascular', ' tratamento cirúrgico de doenças do coração.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cirurgia da Mão', ' sub-especialidade da Ortopedia que aborda os problemas de saúde relacionados as mãos.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cirurgia de cabeça e pescoço', ' tratamento cirúrgico de doenças da cabeça e do pescoço.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cirurgia do Aparelho Digestivo', ' tratamento clínico e cirúrgico dos órgãos do aparelho digestório, como o esôfago, estômago, intestinos, fígado e vias biliares, e pâncreas.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cirurgia Geral', ' é a área que engloba todas as áreas cirúrgicas, sendo também subdividida.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cirurgia Pediátrica', ' cirurgia geral em crianças.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cirurgia Plástica', ' correção das deformidades, malformações ou lesões que comprometem funções dos órgãos através de cirurgia de caráter reparador ou cirurgias estéticas.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cirurgia Torácica', ' atua na cirurgia da caixa torácica e vias aéreas.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Cirurgia Vascular', ' tratamento das veias e artérias, através de cirurgia, procedimentos endovasculares ou tratamentos clínicos.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Clínica Médica (Medicina interna) ', ' é a área que engloba todas as áreas não cirúrgicas, sendo subdividida em várias outras especialidades.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Coloproctologia', ' é a parte da medicina que estuda e trata os problemas do intestino grosso (cólon), sigmoide e doenças do reto, canal anal e ânus.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Dermatologia', ' é o estudo da pele anexos (pelos, glândulas), tratamento e prevenção das as doenças.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Endocrinologia e Metabologia', ' é a área da Medicina responsável pelo cuidados aos hormônios, crescimento e glândulas como adrenal, tireoide, hipófise, pâncreas endócrino e outros.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Endoscopia', ' Esta especialidade médica ocupa-se do estudo dos mecanismo fisiopatológicos, diagnóstico e tratamento de enfermidades passíveis de abordagem por procedimentos endoscópicos e minimamente invasivos.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Gastroenterologia', ' é o estudo, diagnóstico, tratamento e prevenção de doenças relacionadas ao aparelho digestivo, desde erros inatos do metabolismo, doença do trato gastrointestinal, doenças do fígado e cânceres.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Genética médica', ' é a área da responsável pelo estudo das doenças genéticas humanas e aconselhamento genético.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Geriatria', ' é a subespecialidade médica que cuida dos idosos e articula seu tratamento com outras especialidades.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Ginecologia e obstetrícia', ' é a especialidade médica que aborda de forma integral a mulher. Trata desde as doenças infecciosas sexuais, gestação, alterações hormonais, reprodução.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Hematologia e Hemoterapia', ' é o estudo dos elementos figurados do sangue (hemácias, leucócitos, plaquetas) e da produção desses elementos nos órgãos hematopoiéticos (medula óssea, baço, linfonódos), além de tratar das anemias, linfomas, leucemias e outros cânceres, hemofilia e doenças da coagulação
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Homeopatia', ' é a prática médica baseada na Lei dos Semelhantes. (Considerada pseudociência pela comunidade científica por apresentar provas científicas da sua não-eficácia.) [2] [3] [4] [5] [6] [7] [8]
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Infectologia', ' prevenção, diagnóstico e tratamentos de infecções causadas por vírus, bactérias, fungos e parasitas (helmintologia, protozoologia, entomologia e artropodologia).
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Mastologia', ' subespecialidade que trata da mama, suas doenças, alterações benignas e estéticas.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina de Família e Comunidade', ' é a área da medicina que trata do indivíduo em seu ambiente familiar e comunitário, com foco na prevenção e tratamento das doenças mais comuns, sendo o articulador do encaminhamento aos especialistas quando necessária abordagem mais aprofundada das doenças.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina de Emergência', ' especialidade que atua no cuidado de pacientes com doenças ou lesões que requerem atenção médica imediata, atuando nas Emergências, pronto-atendimentos e serviços pré-hospitalares.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina do Trabalho', ' trata do processo de trabalho e da relação deste com as doenças. Atua desde a prevenção dos agravos, a minimização dos efeitos destes e do tratamento das doenças do trabalho quando já estabelecidas.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina do Tráfego', ' manutenção da saúde no indivíduo que se desloca, qualquer que seja o meio, cuidando das interações deste deslocamento com o indivíduo.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina Esportiva', ' abordagem do atleta de uma forma global, desde a fisiologia do exercício à prevenção de lesões, passando pelo controle de treino e resolução de problemas de saúde que envolvam o praticante do exercício físico.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina Física e Reabilitação', ' diagnóstico e terapêutica de diferentes entidades tais como doenças traumáticas, do sistema nervoso central e periférico, orto-traumatológica, cardiorrespiratória.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina Intensiva', ' é o ramo da medicina que se ocupa dos cuidados dos doentes graves ou instáveis, que emprega maior número de recursos tecnológicos e humanos no tratamento de doenças ou complicações de doenças, congregando conhecimento da maioria das especialidades médicas e outras áreas de saúde.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina Legal e Perícia Médica (ou medicina forense)', ' é a especialidade que aplica os conhecimentos médicos aos interesses da Justiça, na elaboração de leis e na adequada caracterização dos fenômenos biológicos que possam interessar às autoridades no sentido da aplicação das leis. Assim a Medicina Legal caracteriza a lesão corporal, a morte (sua causa, o momento em que ocorreu, que agente a produziu), a embriaguez pelo álcool ou pelas demais drogas, a violência sexual de qualquer natureza, etc.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina Nuclear', ' é o estudo imaginológico ou terapia pelo uso de radiofármacos.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Medicina Preventiva e Social', ' se dedica especificamente à prevenção de doenças gerais (de várias áreas), porém não unicamente, já que cada área ou especialidade está também capacitada para tal.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Nefrologia', ' é a parte da medicina que estuda e trata clinicamente as doenças do rim, como insuficiência renal.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Neurocirurgia', ' atua no tratamento de doenças do sistema nervoso central e periférico passíveis de abordagem cirúrgica.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Neurologia', ' é a parte da medicina que estuda e trata o sistema nervoso.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Nutrologia', ' diagnóstico, prevenção e tratamento de doenças do comportamento alimentar.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Obstetrícia', ' é a área da medicina atrelada à Ginecologia que cuida das mulheres em relação ao processo da gestação (pré, pós-parto, puerpério, gestação e outros).
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Oftalmologia', ' é a parte da medicina que estuda e trata os distúrbios dos olhos.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Ortopedia e Traumatologia', ' é a parte da medicina que estuda e trata as doenças do sistema osteomuscular, locomoção, crescimento, deformidades e as fraturas.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Otorrinolaringologia', ' é a parte da medicina que estuda e trata as doenças da orelha, nariz, seios paranasais, faringe e laringe.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Patologia', ' (também anatomia patológica ou patologia cirúrgica) é a especialidade que se ocupa da análise macroscópica, microscópica e molecular das doenças em autópsias, espécimes cirúrgicos, biópsias e preparados citológicos. Ela faz a ligação entre a ciência básica e a prática clínica.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Patologia Clínica/Medicina laboratorial', ' No Brasil, de forma geral é uma especialidade médica investigativa e atua como parte do processo diagnóstico das doenças.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Pediatria', ' é a parte da medicina que estuda e trata crianças.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Pneumologia', ' é a parte da medicina que estuda e trata o sistema respiratório.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Psiquiatria', ' é a parte da medicina que previne e trata ao transtornos mentais e comportamentais.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Radiologia e Diagnóstico por Imagem', ' realização e interpretação de exames de imagem como raio-X, ultrassonografia, Doppler colorido, Tomografia Computadorizada, Ressonância Magnética, entre outros.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Radioterapia', ' tratamento empregado em doenças várias, com o uso de raio X ou outra forma de energia radiante.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Reumatologia', ' é a especialidade médica que trata das doenças do tecido conjuntivo, articulações e doenças autoimunes. Diferente do senso comum o reumatologista não trata somente reumatismo.
');
INSERT INTO `tEspecialidade` (`codigo`, `nome`, `descricao`) VALUES (NULL, 'Urologia', ' é a parte da medicina que estuda e trata cirurgicamente e clinicamente os problemas do sistema urinário e do sistema reprodutor masculino e feminino.
');


####### tMedicoEspecialidade #######

USE trabalho;
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '1', '2');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '1', '16');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '2', '48');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '2', '12');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '3', '39');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '4', '39');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '5', '51');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '6', '13');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '7', '24');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '7', '53');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '8', '19');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '9', '40');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '10', '42');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '10', '54');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '11', '5');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '11', '11');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '12', '5');


####### tClinicaMedico #######

USE trabalho;
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '1');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '1');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '2');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '3');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '1');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '4');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '5');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '5');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '6');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '7');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '8');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '8');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '9');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '10');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '10');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '11');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '12');


####### tClinicaAtendente #######

INSERT INTO `tClinicaAtendente` (`codigo`, `codClinica`, `codAtendente`) VALUES (NULL, '2', '1');
INSERT INTO `tClinicaAtendente` (`codigo`, `codClinica`, `codAtendente`) VALUES (NULL, '1', '2');
INSERT INTO `tClinicaAtendente` (`codigo`, `codClinica`, `codAtendente`) VALUES (NULL, '3', '3');




###### tConsulta ######

INSERT INTO `tConsulta` (`codigo`, `codClinica`, `codAtendente`, `codMedico`, `codPaciente`, `flagConfirmada`, `data`, `hora`, `observacao`, `receita`, `regDate`) VALUES
(6, 3, 0, 10, 2, 0, '2018-10-22', '08:00:00', '', '', '2018-10-14 22:16:06'),
(1, 1, 2, 1, 1, 1, '2018-10-19', '08:30:00', '', '', '2018-10-14 22:06:26'),
(5, 2, 1, 9, 1, 0, '2018-10-19', '18:00:00', '', '', '2018-10-14 22:16:06'),
(3, 3, 3, 5, 3, 0, '2018-10-18', '15:00:00', '', '', '2018-10-14 22:16:06'),
(2, 2, 1, 5, 3, 0, '2018-10-16', '08:00:00', '', '', '2018-10-14 22:09:19'),
(4, 1, 2, 3, 1, 1, '2018-10-09', '09:00:00', 'Nenhuma', 'Tilenol', '2018-10-14 22:16:06'),
(8, 1, 2, 5, 10, 1, '2018-10-04', '16:30:00', 'Nenhuma', 'Repouso', '2018-10-14 22:19:02'),
(7, 1, 2, 1, 2, 1, '2018-10-01', '09:30:00', 'Dores no corpo', 'Relaxante muscular', '2018-10-14 22:16:06');