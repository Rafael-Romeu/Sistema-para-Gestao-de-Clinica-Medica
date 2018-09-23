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
	`data` DATE, `hora` TIME, 
	`observacao` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`receita` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`regDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
	PRIMARY KEY (`codigo`))
	ENGINE = InnoDB;


####### tClinica #######

CREATE TABLE `trabalho`.`tClinica` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`nome` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`cnpj` VARCHAR(17) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`endereco` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`CEP` VARCHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone1` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`telefone2` VARCHAR(27) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`regDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
	`temaCSS` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	PRIMARY KEY (`codigo`),
	UNIQUE `cnpj` (`cnpj`))
	ENGINE = InnoDB;


####### tAtendente #######

CREATE TABLE `trabalho`.`tAtendente` ( 
	`codigo` INT NOT NULL AUTO_INCREMENT , 
	`nome` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`senha` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	`cpf` VARCHAR(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	`dataNascimento` DATE,
	`endereco` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`CEP` VARCHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
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
	`cpf` VARCHAR(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`planoDeSaude` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`dataNascimento` DATE, 
	`endereco` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`CEP` VARCHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
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
	`cpf` VARCHAR(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`planoDeSaude` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`genero` VARCHAR(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`tipoSanguineo` VARCHAR(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`dataNascimento` DATE, 
	`endereco` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
	`CEP` VARCHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
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
INSERT INTO `tClinica` (`codigo`, `nome`, `cnpj`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`, `temaCSS`) VALUES (NULL, 'Mayo CLinic', '77777777777777717', '1216 Second Street SW Rochester, MN, US', '55902-190', '+1 (507) 405-0312', '', 'www.mayoclinic.org', CURRENT_TIMESTAMP, '');
INSERT INTO `tClinica` (`codigo`, `nome`, `cnpj`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`, `temaCSS`) VALUES (NULL, 'Grey Sloan Memorial Hospital', '77777777777777718', '15000 Centennial Drive Seattle, Washington, US', '98109', '+1 (206) 555-6000', '', 'http://greysanatomy.wikia.com/wiki/Grey_Sloan_Memorial_Hospital', CURRENT_TIMESTAMP, '');
INSERT INTO `tClinica` (`codigo`, `nome`, `cnpj`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`, `temaCSS`) VALUES (NULL, 'Princeton-Plainsboro Teaching Hospital', '77777777777777719', 'Princeton, NJ, US', '08544', '+1 (609) 258-3000', '', 'http://house.wikia.com/wiki/Princeton-Plainsboro_Teaching_Hospital', CURRENT_TIMESTAMP, '');

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
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'GLAUBER ACUNHA GONCALVES', '1234567', '04166482486','Executive', '', 'AB+', '1981-02-10', 'Rua 2, 3813', '99091186', '+55 53 3233 9980', '+55 53 9466 9643', 'glauber@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SILVIA SILVA DA COSTA BOTELHO', '1234567', '22906311945','Master', '', 'B+', '1990-04-18', 'Rua 3, 2871', '97305061', '+55 54 3233 4234', '+55 54 9350 9440', 'silvia@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SEBASTIAO CICERO PINHEIRO GOMES', '1234567', '13352874137','Standard', '', 'O-', '1984-07-17', 'Rua 4, 3557', '99847247', '+55 53 3233 5172', '+55 53 9117 9484', 'sebastiao@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'GERALCY CARNEIRO DA SILVA', '1234567', '11829728799','Platinum', '', 'A+', '1990-10-15', 'Rua 5, 8580', '93647691', '+55 54 3233 2645', '+55 54 9596 9998', 'geralcy@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CLAUDIO DORNELLES MELLO JUNIOR', '1234567', '39853277300','Master', '', 'A-', '1979-09-24', 'Rua 6, 4985', '90069014', '+55 53 3233 5743', '+55 53 9766 9135', 'claudio@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'PEDRO RICARDO DEL SANTORO', '1234567', '23480292942','Standard', '', 'B+', '1983-10-01', 'Rua 7, 7429', '99032010', '+55 53 3233 1367', '+55 53 9967 9917', 'pedro@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ALESSANDRO DE LIMA BICHO', '1234567', '16790329820','Platinum', '', 'B+', '1987-10-26', 'Rua 8, 3927', '91704827', '+55 53 3233 3210', '+55 53 9300 9772', 'alessandro@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'VITOR IRIGON GERVINI', '1234567', '14682921845','Standard', '', 'A-', '1977-07-02', 'Rua 9, 938', '95507639', '+55 53 3233 9999', '+55 53 9800 9639', 'vitor@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'LEONARDO RAMOS EMMENDORFER', '1234567', '06812029392','Executive', '', 'A+', '1977-05-22', 'Rua 10, 9833', '90397639', '+55 53 3233 9119', '+55 53 9545 9095', 'leonardo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'FABRICIO FERRARI', '1234567', '35874976554','Standard', '', 'AB-', '1976-01-10', 'Rua 11, 85', '93027172', '+55 53 3233 4377', '+55 53 9386 9804', 'fabricio@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'VAGNER SANTOS DA ROSA', '1234567', '37347291536','Standard', '', 'A+', '1980-07-26', 'Rua 12, 9993', '98241150', '+55 54 3233 6240', '+55 53 9584 9378', 'vagner@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ADRIANO VELASQUE WERHLI', '1234567', '33271470071','Master', '', 'A+', '1989-02-02', 'Rua 13, 198', '94183367', '+55 54 3233 5527', '+55 54 9183 9298', 'adriano@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'FABIANA TRAVESSINI DE CEZARO', '1234567', '20887924935','Master', '', 'O+', '1980-12-20', 'Rua 14, 9260', '95034174', '+55 54 3233 2030', '+55 54 9838 9478', 'fabiana@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'EDUARDO NUNES BORGES', '1234567', '28349910564','Executive', '', 'A+', '1975-06-11', 'Rua 15, 8780', '94705386', '+55 53 3233 9611', '+55 54 9315 9275', 'eduardo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'EWERSON LUIZ DE SOUZA CARVALHO', '1234567', '03354277540','Standard', '', 'B+', '1989-04-24', 'Rua 16, 5439', '93319043', '+55 54 3233 7260', '+55 54 9092 9168', 'ewerson@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DIANA FRANCISCA ADAMATTI', '1234567', '08004664883','Executive', '', 'O+', '1987-03-15', 'Rua 17, 1152', '90425734', '+55 54 3233 8159', '+55 54 9778 9865', 'diana@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'VIVIANE LEITE DIAS DE MATTOS', '1234567', '05738521384','Executive', '', 'B-', '1985-06-03', 'Rua 18, 660', '97468139', '+55 53 3233 2787', '+55 54 9281 9605', 'viviane@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'REGINA BARWALDT', '1234567', '27462866302','Master', '', 'O-', '1973-04-01', 'Rua 19, 8951', '92180751', '+55 53 3233 6334', '+55 54 9155 9610', 'regina@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DANIEL HELBIG', '1234567', '19204600429','Standard', '', 'O+', '1988-01-15', 'Rua 20, 4426', '92892315', '+55 54 3233 6816', '+55 53 9760 9453', 'daniel@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'LUCIANO SILVA DA SILVA', '1234567', '03686615653','Master', '', 'O-', '1980-09-08', 'Rua 21, 4090', '95041504', '+55 53 3233 6177', '+55 54 9584 9986', 'luciano@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SABRINA MADRUGA NOBRE', '1234567', '37082651232','Platinum', '', 'AB-', '1990-08-04', 'Rua 22, 5415', '92887479', '+55 54 3233 5885', '+55 53 9539 9688', 'sabrina@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'LUCIANO MACIEL RIBEIRO', '1234567', '19032227404','Executive', '', 'B+', '1990-09-25', 'Rua 23, 6113', '90099303', '+55 54 3233 7494', '+55 53 9025 9090', 'luciano@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'MARCELO RITA PIAS', '1234567', '26804566799','Executive', '', 'B+', '1979-11-11', 'Rua 24, 4483', '94624477', '+55 53 3233 4974', '+55 54 9430 9515', 'marcelo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CLEO ZANELLA BILLA', '1234567', '30904687559','Executive', '', 'O+', '1984-08-23', 'Rua 25, 2506', '99913923', '+55 54 3233 1185', '+55 53 9912 9404', 'cleo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'PAULO LILLES JORGE DREWS JUNIOR', '1234567', '16509749598','Platinum', '', 'B+', '1981-11-17', 'Rua 26, 2930', '94103294', '+55 54 3233 3280', '+55 53 9102 9466', 'paulo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'RODRIGO ZELIR AZZOLIN', '1234567', '04039397498','Platinum', '', 'A-', '1977-09-26', 'Rua 27, 3980', '98746084', '+55 54 3233 6316', '+55 53 9152 9266', 'rodrigo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ODORICO MACHADO MENDIZABAL', '1234567', '39411236142','Platinum', '', 'B+', '1977-10-06', 'Rua 28, 2528', '99881879', '+55 53 3233 2192', '+55 54 9684 9768', 'odorico@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'PAULO FRANCISCO BUTZEN', '1234567', '18683582437','Standard', '', 'AB+', '1972-07-14', 'Rua 29, 7781', '95848986', '+55 53 3233 7560', '+55 54 9681 9956', 'paulo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'KARINA DOS SANTOS MACHADO', '1234567', '18435437908','Master', '', 'A-', '1974-02-18', 'Rua 30, 4795', '90601082', '+55 54 3233 4067', '+55 54 9845 9075', 'karina@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'OCTAVIO DE CASTILHOS BADIA', '1234567', '11851208071','Executive', '', 'A+', '1971-01-11', 'Rua 31, 5857', '92443752', '+55 53 3233 7000', '+55 53 9911 9778', 'octavio@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JAQUELINE RITTER', '1234567', '20548186450','Platinum', '', 'O+', '1980-02-07', 'Rua 32, 3374', '92222682', '+55 54 3233 3876', '+55 53 9934 9099', 'jaqueline@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JOSE RODRIGO FURLANETTO DE AZAMBUJA', '1234567', '32251666400','Master', '', 'O+', '1976-12-17', 'Rua 33, 8775', '98478273', '+55 54 3233 3361', '+55 54 9880 9806', 'jose@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'GISELE MORAES SIMAS', '1234567', '13589464095','Master', '', 'AB-', '1977-06-24', 'Rua 34, 8523', '96789989', '+55 53 3233 5610', '+55 53 9785 9679', 'gisele@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'RODRIGO ROCHA DAVESAC', '1234567', '20530629973','Standard', '', 'O-', '1984-11-18', 'Rua 35, 3173', '90324474', '+55 54 3233 1399', '+55 53 9867 9159', 'rodrigo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'MAURO MEDEIROS BARBAT', '1234567', '23368200375','Master', '', 'O+', '1990-11-26', 'Rua 36, 1698', '95942868', '+55 54 3233 6813', '+55 54 9699 9000', 'mauro@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'AGUEDA MARIA TURATTI', '1234567', '16694875398','Executive', '', 'A+', '1990-01-16', 'Rua 37, 1457', '99418399', '+55 53 3233 4191', '+55 54 9170 9546', 'agueda@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DENALIZE GOULART LEITE', '1234567', '33966438873','Master', '', 'A+', '1972-05-08', 'Rua 38, 2406', '96069311', '+55 54 3233 2410', '+55 53 9929 9786', 'denalize@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CRISTIANO RAFAEL STEFFENS', '1234567', '14586769468','Master', '', 'O-', '1970-06-07', 'Rua 39, 2537', '93100548', '+55 54 3233 9209', '+55 53 9698 9742', 'cristiano@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'BIANCA NEVES MACHADO', '1234567', '04492465650','Master', '', 'O-', '1989-06-06', 'Rua 40, 4057', '91220827', '+55 54 3233 9025', '+55 54 9434 9025', 'bianca@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SANTIAGO VALDES RAVELO', '1234567', '08473021170','Standard', '', 'AB+', '1989-10-04', 'Rua 41, 8430', '93462803', '+55 53 3233 5540', '+55 53 9056 9074', 'santiago@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JUSOAN LANG MOR', '1234567', '25528675580','Platinum', '', 'B-', '1978-06-07', 'Rua 42, 9273', '98375474', '+55 54 3233 6212', '+55 54 9249 9986', 'jusoan@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CAIO CESAR CARDOSO DA SILVA', '1234567', '29738494810','Standard', '', 'AB+', '1984-12-13', 'Rua 43, 859', '98907453', '+55 54 3233 5314', '+55 53 9429 9530', 'caio@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'LETICIA BERNEIRA CARDOZO', '1234567', '08645609702','Platinum', '', 'A+', '1985-07-02', 'Rua 44, 8758', '93048992', '+55 54 3233 4397', '+55 53 9799 9919', 'leticia@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'VINICIUS MENEZES DE OLIVEIRA', '1234567', '21859147527','Platinum', '', 'O+', '1984-10-22', 'Rua 45, 1128', '99892841', '+55 53 3233 5742', '+55 54 9917 9192', 'vinicius@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'VINICIUS HEIDTMANN AVILA', '1234567', '23090228563','Standard', '', 'O-', '1973-02-01', 'Rua 46, 1755', '90977677', '+55 53 3233 3362', '+55 53 9750 9560', 'vinicius@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JOEL FELIPE DE OLIVEIRA GAYA', '1234567', '32839080644','Executive', '', 'AB+', '1975-07-23', 'Rua 47, 712', '92404715', '+55 53 3233 6558', '+55 54 9461 9546', 'joel@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ANDRE PRISCO VARGAS', '1234567', '26972651304','Executive', '', 'AB-', '1990-02-06', 'Rua 48, 5860', '92472875', '+55 54 3233 4986', '+55 54 9830 9036', 'andre@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DANUBIA BUENO ESPINDOLA', '1234567', '20571521590','Platinum', '', 'B-', '1990-08-05', 'Rua 49, 1053', '91181107', '+55 53 3233 8530', '+55 54 9747 9547', 'danubia@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CRISTINA MEINHARDT', '1234567', '20384979598','Executive', '', 'AB+', '1977-11-02', 'Rua 50, 4488', '90789830', '+55 53 3233 2596', '+55 54 9600 9443', 'cristina@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'EDER MATEUS NUNES GONCALVES', '1234567', '25912190525','Standard', '', 'A+', '1977-02-13', 'Rua 51, 4418', '98750148', '+55 53 3233 4153', '+55 54 9623 9092', 'eder@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'RAFAEL AUGUSTO PENNA DOS SANTOS', '1234567', '15276936682','Platinum', '', 'O-', '1978-02-26', 'Rua 52, 6019', '97826615', '+55 53 3233 7146', '+55 54 9083 9393', 'rafael@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'GRACALIZ PEREIRA DIMURO', '1234567', '16462451562','Standard', '', 'B+', '1987-10-18', 'Rua 53, 5307', '97938537', '+55 53 3233 5654', '+55 53 9268 9951', 'gracaliz@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'RICARDO NAGEL RODRIGUES', '1234567', '27194767671','Platinum', '', 'AB-', '1987-10-01', 'Rua 54, 2094', '97451050', '+55 53 3233 5546', '+55 54 9036 9444', 'ricardo@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DESIREE FRIPP DOS SANTOS', '1234567', '28903825726','Executive', '', 'O+', '1988-12-20', 'Rua 55, 5419', '96965012', '+55 54 3233 2682', '+55 54 9321 9679', 'desiree@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ADILSON AROCHA PEDROSO', '1234567', '26069813289','Executive', '', 'B-', '1988-07-18', 'Rua 56, 8846', '91800206', '+55 54 3233 5123', '+55 53 9216 9659', 'adilson@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JURSELEM CARVALHO PEREZ', '1234567', '14209174028','Master', '', 'A-', '1987-11-17', 'Rua 57, 3030', '99766736', '+55 54 3233 3796', '+55 53 9902 9260', 'jurselem@furg.br', CURRENT_TIMESTAMP);
INSERT INTO `tPaciente` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `genero`, `tipoSanguineo`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'NELSON LOPES DUARTE FILHO', '1234567', '23819384361','Standard', '', 'AB+', '1986-06-20', 'Rua 58, 4854', '99378646', '+55 54 3233 1661', '+55 53 9871 9982', 'nelson@furg.br', CURRENT_TIMESTAMP);


####### tMedico #######

USE trabalho;
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ADDISON MONTGOMERY', '1234567', '09591505328','Executive', '1983-01-26', 'Rua 1, 6421', '94259715', '+55 53 3233 1808', '+55 53 9732 9614', 'addison@outlook.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'AMBER VOLAKIS', '1234567', '21140113248','Executive', '1989-06-08', 'Rua 2, 7142', '95648153', '+55 54 3233 2897', '+55 53 9547 9900', 'amber@apple.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'AMELIA SHEPHERD', '1234567', '38716870620','Executive', '1980-01-02', 'Rua 3, 6253', '91361637', '+55 54 3233 9802', '+55 54 9666 9325', 'amelia@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CALLIE TORRES', '1234567', '12996447159','Executive', '1975-01-18', 'Rua 4, 1934', '90679115', '+55 54 3233 4271', '+55 53 9057 9588', 'callie@apple.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ALLISON CAMERON', '1234567', '40534699976','Master', '1975-07-12', 'Rua 5, 699', '94037125', '+55 53 3233 6684', '+55 54 9877 9661', 'allison@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CHARLOTTE KING', '1234567', '28487032027','Standard', '1980-06-05', 'Rua 6, 7656', '97101620', '+55 53 3233 2007', '+55 53 9707 9114', 'charlotte@apple.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ROBERT CHASE', '1234567', '36284703741','Executive', '1971-11-20', 'Rua 7, 5715', '97097614', '+55 54 3233 7418', '+55 54 9913 9562', 'robert@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CHRISTOPHER TURK', '1234567', '06613216613','Executive', '1978-01-04', 'Rua 8, 8022', '92122361', '+55 54 3233 9991', '+55 53 9086 9879', 'christopher@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'COOPER FREEDMAN', '1234567', '14547213321','Master', '1983-08-06', 'Rua 9, 6916', '94489080', '+55 54 3233 3699', '+55 53 9443 9976', 'cooper@outlook.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'LISA CUDDY', '1234567', '34528883479','Master', '1982-01-13', 'Rua 10, 6899', '90631202', '+55 54 3233 1413', '+55 54 9377 9370', 'lisa@hotmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DELL PARKER', '1234567', '34671107609','Master', '1972-11-01', 'Rua 11, 4283', '90291862', '+55 53 3233 1017', '+55 54 9932 9068', 'dell@outlook.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DEREK SHEPHERD', '1234567', '47638894991','Executive', '1970-03-10', 'Rua 12, 2914', '96366372', '+55 54 3233 6719', '+55 54 9042 9129', 'derek@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOCTOR ZOIDBERG', '1234567', '15306911651','Master', '1986-10-09', 'Rua 13, 7232', '93200897', '+55 53 3233 5726', '+55 54 9263 9617', 'doctor@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOOGIE HOWSER, M.D.', '1234567', '05842176015','Executive', '1988-03-26', 'Rua 14, 2628', '93621796', '+55 54 3233 4514', '+55 54 9253 9146', 'doogie@gmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOUTOR (STAR TREK)', '1234567', '25217435816','Master', '1977-10-05', 'Rua 15, 274', '95370827', '+55 53 3233 2726', '+55 54 9882 9107', 'doutor@gmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOUTOR CHAPATÍN', '1234567', '39650383019','Standard', '1986-03-01', 'Rua 16, 802', '94835056', '+55 53 3233 1293', '+55 54 9912 9485', 'doutor@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOUTOR ESTRANHO', '1234567', '42519743453','Master', '1979-09-26', 'Rua 17, 6137', '96022935', '+55 53 3233 4134', '+55 53 9640 9255', 'doutor@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOUTOR LUZ', '1234567', '32694364380','Executive', '1979-08-21', 'Rua 18, 3190', '90449362', '+55 53 3233 6136', '+55 54 9973 9989', 'doutor@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOUTORA BRINQUEDOS', '1234567', '05899704028','Master', '1982-04-25', 'Rua 19, 654', '91370249', '+55 54 3233 5668', '+55 53 9075 9541', 'doutora@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DR. KILDARE', '1234567', '17123219553','Master', '1980-11-22', 'Rua 20, 3747', '92871924', '+55 53 3233 4696', '+55 53 9712 9045', 'dr.@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ELLIOT REID', '1234567', '22619273031','Platinum', '1990-04-02', 'Rua 21, 1621', '98275908', '+55 54 3233 3239', '+55 53 9379 9275', 'elliot@outlook.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ERIC FOREMAN', '1234567', '16477948692','Executive', '1972-04-18', 'Rua 22, 5514', '99657695', '+55 54 3233 3761', '+55 53 9390 9965', 'eric@medic.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'FU MANCHU', '1234567', '16786257916','Master', '1972-01-12', 'Rua 23, 8393', '92352616', '+55 53 3233 8861', '+55 54 9434 9253', 'fu@gmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'GEORGE O`MALLEY', '1234567', '09663747023','Standard', '1987-03-02', 'Rua 24, 1691', '93122702', '+55 54 3233 9294', '+55 53 9358 9285', 'george@hotmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ALAN HARPER', '1234567', '04992030033','Standard', '1983-11-02', 'Rua 25, 9082', '97647814', '+55 54 3233 6144', '+55 53 9722 9981', 'alan@apple.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'HERSHEL GREENE', '1234567', '14774342526','Platinum', '1976-08-08', 'Rua 26, 6001', '96108022', '+55 53 3233 4536', '+55 54 9297 9844', 'hershel@hotmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DR. JULIUS HIBBERT', '1234567', '31620068466','Platinum', '1970-05-05', 'Rua 27, 1555', '97306786', '+55 54 3233 6842', '+55 53 9495 9936', 'dr.@apple.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'GREGORY HOUSE', '1234567', '42376015444','Standard', '1973-06-25', 'Rua 28, 8337', '92204464', '+55 54 3233 1174', '+55 54 9833 9281', 'gregory@outlook.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JOHN DORIAN', '1234567', '42832412046','Executive', '1982-03-21', 'Rua 29, 5005', '96627344', '+55 54 3233 6827', '+55 54 9427 9259', 'john@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JULIAN BASHIR', '1234567', '27768429591','Standard', '1982-11-24', 'Rua 30, 3180', '95036075', '+55 54 3233 6661', '+55 54 9068 9910', 'julian@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JULIET BURKE', '1234567', '29350295312','Executive', '1978-03-16', 'Rua 31, 2536', '94001240', '+55 53 3233 2066', '+55 54 9572 9853', 'juliet@medic.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'KARL RUPRECHT KROENEN', '1234567', '45137151416','Standard', '1971-03-04', 'Rua 32, 2419', '97585495', '+55 54 3233 6578', '+55 54 9106 9826', 'karl@outlook.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'LAWRENCE KUTNER', '1234567', '28738969401','Master', '1972-02-11', 'Rua 33, 1272', '99929385', '+55 53 3233 5441', '+55 54 9621 9913', 'lawrence@apple.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'RAY LANGSTON', '1234567', '28678915304','Standard', '1990-09-14', 'Rua 34, 7252', '91222630', '+55 54 3233 3331', '+55 53 9825 9242', 'ray@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'LEONARD MCCOY', '1234567', '34107618412','Platinum', '1975-06-23', 'Rua 35, 6235', '92652028', '+55 53 3233 3169', '+55 53 9216 9865', 'leonard@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'LEORIO PARADINIGHT', '1234567', '48410706461','Master', '1985-11-01', 'Rua 36, 5404', '95947802', '+55 54 3233 6556', '+55 53 9920 9627', 'leorio@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'LEXIE GREY', '1234567', '46242660242','Master', '1975-08-10', 'Rua 37, 1151', '99849587', '+55 54 3233 4430', '+55 53 9947 9603', 'lexie@outlook.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'MARIO (PERSONAGEM)', '1234567', '04325650120','Platinum', '1977-02-11', 'Rua 38, 612', '97559803', '+55 53 3233 3335', '+55 53 9771 9130', 'mario@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'MARK SLOAN', '1234567', '43972081959','Executive', '1987-10-27', 'Rua 39, 300', '96002660', '+55 53 3233 3396', '+55 53 9958 9379', 'mark@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'MARTHA M. MASTERS', '1234567', '15445890360','Executive', '1973-12-24', 'Rua 40, 4262', '95640337', '+55 54 3233 5146', '+55 53 9348 9956', 'martha@hotmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'HERB MELNICK', '1234567', '24672320895','Standard', '1979-08-14', 'Rua 41, 8789', '93049575', '+55 54 3233 2196', '+55 54 9276 9573', 'herb@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'MEREDITH GREY', '1234567', '36565784015','Standard', '1985-01-12', 'Rua 42, 8136', '94324672', '+55 53 3233 2663', '+55 54 9610 9122', 'meredith@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'NAOMI BENNETT', '1234567', '39401367918','Platinum', '1989-09-27', 'Rua 43, 2534', '95888287', '+55 53 3233 8377', '+55 53 9272 9546', 'naomi@email.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DR. NICK RIVIERA', '1234567', '17243434686','Master', '1976-11-04', 'Rua 44, 2599', '91639189', '+55 54 3233 4085', '+55 53 9835 9753', 'dr.@medic.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'OWEN HUNT', '1234567', '46621701862','Standard', '1982-07-20', 'Rua 45, 3095', '93867643', '+55 53 3233 2206', '+55 53 9833 9213', 'owen@gmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'PETE WILDER', '1234567', '22933824835','Platinum', '1988-05-22', 'Rua 46, 7835', '96988260', '+55 54 3233 6473', '+55 53 9227 9654', 'pete@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'PHLOX (STAR TREK)', '1234567', '25315211962','Executive', '1990-03-24', 'Rua 47, 4487', '90663723', '+55 54 3233 2941', '+55 53 9123 9067', 'phlox@medic.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'PROFESSOR HAMILTON', '1234567', '09747368984','Platinum', '1984-09-06', 'Rua 48, 2071', '98389677', '+55 53 3233 5296', '+55 54 9298 9389', 'professor@hotmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'RICHARD WEBBER', '1234567', '32538075063','Executive', '1990-10-08', 'Rua 49, 9256', '93148168', '+55 53 3233 1659', '+55 53 9132 9211', 'richard@gmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ALBERT ROBBINS', '1234567', '20130138668','Standard', '1980-07-21', 'Rua 50, 6776', '91952480', '+55 53 3233 8349', '+55 54 9223 9423', 'albert@apple.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'ARIZONA ROBBINS', '1234567', '05646347232','Standard', '1982-04-27', 'Rua 51, 498', '97485169', '+55 53 3233 1336', '+55 54 9413 9591', 'arizona@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SAKURA HARUNO', '1234567', '11954496659','Executive', '1975-09-15', 'Rua 52, 8804', '94524840', '+55 53 3233 9686', '+55 53 9878 9790', 'sakura@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SAM BENNETT', '1234567', '24926686366','Standard', '1983-12-05', 'Rua 53, 3310', '97509757', '+55 53 3233 9358', '+55 53 9567 9454', 'sam@medic.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOUTOR SAMSON', '1234567', '49082878519','Standard', '1988-12-12', 'Rua 54, 1550', '97281216', '+55 54 3233 7621', '+55 53 9353 9923', 'doutor@outlook.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOC SAVAGE', '1234567', '16276550819','Master', '1979-07-14', 'Rua 55, 3797', '96288040', '+55 53 3233 2516', '+55 53 9453 9024', 'doc@medic.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JACK SHEPHARD', '1234567', '20601114172','Executive', '1979-03-15', 'Rua 56, 4864', '95804998', '+55 53 3233 6933', '+55 54 9398 9323', 'jack@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'DOUTOR ZACHARY SMITH', '1234567', '29864633360','Platinum', '1984-11-23', 'Rua 57, 6715', '97543724', '+55 54 3233 9582', '+55 54 9569 9556', 'doutor@apple.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'SPIDER-MAN 2099', '1234567', '16281430544','Platinum', '1985-11-04', 'Rua 58, 1517', '97639092', '+55 53 3233 3512', '+55 53 9015 9107', 'spider-man@hotmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'IZZIE STEVENS', '1234567', '04515455250','Standard', '1975-10-05', 'Rua 59, 7996', '97498960', '+55 54 3233 5142', '+55 53 9465 9743', 'izzie@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'CHRIS TAUB', '1234567', '29044126841','Platinum', '1974-07-26', 'Rua 60, 6635', '90974548', '+55 54 3233 2286', '+55 54 9855 9509', 'chris@gmail.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'TEMPERANCE BRENNAN', '1234567', '37420578917','Executive', '1970-04-19', 'Rua 61, 288', '93496777', '+55 54 3233 5963', '+55 53 9087 9691', 'temperance@heaven.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'THIRTEEN (HOUSE)', '1234567', '12318530577','Platinum', '1975-05-13', 'Rua 62, 5881', '98648179', '+55 53 3233 7599', '+55 54 9297 9269', 'thirteen@yahoo.com', CURRENT_TIMESTAMP);
INSERT INTO `tMedico` (`codigo`, `nome`, `senha`, `cpf`, `planoDeSaude`, `dataNascimento`, `endereco`, `CEP`, `telefone1`, `telefone2`, `email`, `regDate`) VALUES (NULL, 'JAMES WILSON (HOUSE)', '1234567', '38146772554','Platinum', '1980-11-07', 'Rua 63, 4614', '94976355', '+55 53 3233 9692', '+55 54 9350 9318', 'james@heaven.com', CURRENT_TIMESTAMP);



####### tHorarioAtendimento #######

USE trabalho;

INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '1', '2', '0110000000111100010110', '0000000000000000000000', '0000000000000000000000', '0001110011101011101010', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '2', '3', '1010111100110101111001', '0000000000000000000000', '0000000000000000000000', '1111101010111010011101', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '2', '2', '0111011101000100101110', '0000000000000000000000', '1001111100111010000011', '1111101010111010011101', '0011001101111001001100');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '3', '3', '0000000000000000000000', '0111010111100001010010', '1111001010000111001000', '0000000000000000000000', '1000010001011100011011');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '3', '1', '0000000000000000000000', '0101001110100011111011', '1111001010000111001000', '1110010100010000110001', '1100000001001011000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '4', '2', '0111010111100110011000', '0000000000000000000000', '0000000000000000000000', '0100001010111011010101', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '4', '1', '0111010111100110011000', '0001101010001010010011', '0000000001010110111000', '0111010100111100000111', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '5', '2', '0000000000000000000000', '0111001010010100011001', '0000000000000000000000', '1100100111100010111101', '1000000110011100111110');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '5', '3', '0101000011000101101001', '0100111001100010111100', '0000000000000000000000', '1100100111100010111101', '1000000110011100111110');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '6', '1', '1010101001000011100100', '0011001001000110100100', '0000000000000000000000', '0000000000000000000000', '0110110001111101100000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '6', '2', '1010101001000011100100', '0011001001000110100100', '0000000000000000000000', '0100101100011100101011', '0011010100001110001001');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '7', '2', '0000000000000000000000', '0000000000000000000000', '0100111111010100000101', '1100110100000010011011', '0010110001000101001001');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '8', '2', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '1100000010100101000000', '1110000100110000010100');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '8', '3', '1001010100011100111011', '0000000000000000000000', '1000100001101111111101', '1100000010100101000000', '1011100011110001100010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '9', '2', '0000000000000000000000', '1100101100010101000101', '0000000000000000000000', '0000000000000000000000', '0001010110000100010010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '9', '1', '0011110001001110010101', '0111001011101011000110', '0000000000000000000000', '0000000000000000000000', '0001010110000100010010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '10', '3', '1111001011101101010101', '0000000000000000000000', '0000101010000010100001', '0000000000000000000000', '0011111011000101011010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '10', '1', '1011100111110000010010', '0000000000000000000000', '1111110000100001111001', '0000000000000000000000', '0011111011000101011010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '11', '1', '0000110011000111101000', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '12', '2', '0000000000000000000000', '0101100101110100010000', '0000000000000000000000', '0000000000000000000000', '1111110100111100000110');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '13', '2', '0000000000000000000000', '0000000000000000000000', '0001001000101110011011', '0000011100110100101011', '0100011000111100101011');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '14', '2', '1000000010101111110001', '0000000000000000000000', '1000000111110011111011', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '15', '1', '0000000000000000000000', '1101110000101101111100', '0000000000000000000000', '1100011111000000001100', '1111010011011001000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '15', '3', '0001001100110001111111', '1101110000101101111100', '1110000010011100010110', '1100011111000000001100', '1111010011011001000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '16', '3', '0000000000000000000000', '0000000000000000000000', '0110101000001011110010', '1101001101100111110101', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '17', '3', '1110000101100001111100', '0000000000000000000000', '0111101000000101100011', '0000000000000000000000', '0001010101111000010111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '18', '2', '0000000000000000000000', '0100110110011100100011', '0000000000000000000000', '0000000000000000000000', '0110001100010001110000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '19', '2', '0010010101000010110111', '0110110001100000111110', '0000000000000000000000', '1111011101111100101000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '20', '1', '0000000000000000000000', '0000000000000000000000', '1101000110101001110010', '0001000001010010100010', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '20', '2', '0111111110010101010111', '1100001110100110000010', '1101000110101001110010', '0001000001010010100010', '0011011011111111001011');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '21', '1', '1111101101010110101101', '0000000000000000000000', '1110110111001001100011', '0011110000110101111110', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '21', '3', '1111101101010110101101', '1011010000100100011111', '1110110111001001100011', '0110011111110001010100', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '22', '2', '0000011111011100011111', '0011010111011011000000', '0000000000000000000000', '0000000000000000000000', '0101111111010101101110');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '23', '3', '0000000000000000000000', '0000000000000000000000', '1000000011101110110010', '0000000000000000000000', '1010100011110011101001');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '23', '1', '0000000000000000000000', '0000000000000000000000', '1110000011001000010011', '0001010100000000110100', '1010100011110011101001');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '24', '2', '0001100111010000100000', '0110001011101000111110', '0101100011011100001100', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '24', '3', '0111100100110011101010', '0110011000010001110000', '0101100011011100001100', '0011010011010000011001', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '25', '1', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '0100100001111100001011', '0001001001100111010010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '26', '1', '0001100001000100001110', '0101110011000101111001', '0000000000000000000000', '0000000000000000000000', '0011011111001111110110');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '27', '1', '0000000000000000000000', '1000011001010000001101', '0000100001001100000110', '0000000000000000000000', '1000001100011001101100');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '28', '2', '0000000000000000000000', '1001100010010111100100', '0000000000000000000000', '0000000000000000000000', '0010110000001100111000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '29', '2', '0000000000000000000000', '0100111001111011111110', '0000000000000000000000', '1110101010101110101001', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '30', '3', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '0110000011110001100101', '1001101110001101110010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '30', '1', '0000000000000000000000', '1110101100110000111000', '0000000000000000000000', '0110000011110001100101', '1001101110001101110010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '31', '3', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '1000101010110110000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '32', '1', '1111100001010111100001', '0000000000000000000000', '1111100000010001111001', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '32', '2', '1111100001010111100001', '1010000001011000110001', '1111100000010001111001', '0001011010101010110001', '1110011001001110100001');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '33', '2', '0000000000000000000000', '0100110000001010000100', '0000000000000000000000', '0101001011010110100000', '1010101011100100101000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '34', '3', '0000000000000000000000', '0000000000000000000000', '0111101111111010000100', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '34', '1', '0001011110110001000010', '0000000000000000000000', '0111101111111010000100', '1110100110000000101100', '0101100011100101010101');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '35', '3', '0000000000000000000000', '0000000000000000000000', '1001010100110010010110', '0000000000000000000000', '0101011000111001001011');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '35', '2', '0000000000000000000000', '0000000000000000000000', '0100101000000110011010', '1111001011100101110101', '0101011000111001001011');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '36', '1', '0111111000010001001110', '1010111011000001111111', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '37', '3', '0101010000011011000001', '0000000000000000000000', '0000000000000000000000', '0111110011100001000100', '1001010111010000010000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '38', '2', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '1101010110110101000100', '1111011100011101010101');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '39', '2', '0100001101101010010101', '0000000010011101101001', '0001010010011001100011', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '39', '3', '0011101001111100001100', '0000000010011101101001', '0011100001011010101000', '0011110111100110111111', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '40', '3', '1000111000000100011101', '1011100010110111000000', '0000000000000000000000', '0000000000000000000000', '0011110101011101000011');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '41', '3', '0000000000000000000000', '0000000000000000000000', '1111111100000110101010', '1000110110001101001100', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '41', '1', '0000000000000000000000', '0000000000000000000000', '0001010011110010111101', '1111000001101111000010', '1001101101001110100001');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '42', '2', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '1100111110010111110011', '1001000101110101011111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '43', '1', '0000000000000000000000', '1001100111001110111011', '1111101010110000010010', '0000000000000000000000', '1001101101101110101010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '44', '2', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '1010000101001010111101', '0110001001010010010101');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '45', '1', '0101011111010101100010', '0000000000000000000000', '0000000000000000000000', '1001010111111011011100', '0111011101110011001100');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '45', '2', '0101011111010101100010', '0000000000000000000000', '0110010010101011010000', '1001010111111011011100', '1011100100111010111011');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '46', '3', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '0010101001001001010011', '0010101001111100101010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '46', '1', '0000000000000000000000', '1010001000101111001000', '0111010001100110000110', '0010010011111001010011', '0010101001111100101010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '47', '2', '0000000000000000000000', '0101010000100101110110', '0001001111101111110111', '0000000000000000000000', '0011111000000000001101');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '48', '3', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '1101100100100100001001', '1000001010011011101010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '49', '3', '1001111111101011010010', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '1001110010111110101110');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '50', '1', '0000000000000000000000', '0000000000000000000000', '1010011001101110011001', '1010111001101001001010', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '51', '3', '1111110100000100110101', '1000011110011000110011', '0000000000000000000000', '0000000000000000000000', '1010111111011111110100');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '51', '2', '1111110100000100110101', '1100011000000001001101', '0000111000000100111001', '0000000000000000000000', '1011110111101100000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '52', '3', '0000000000000000000000', '0001111101110111101101', '0000110001010001001011', '0000000000000000000000', '1001001010011010101010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '52', '1', '0110010001111001011111', '1001001001000001011100', '0011010001000100010010', '0000000000000000000000', '1001001010011010101010');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '53', '1', '0000000000000000000000', '1101010111000100010101', '0110000100101100011001', '0000000000000000000000', '0001011001101001000111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '54', '3', '0000000000000000000000', '0000101110110110010010', '0110101000000100000100', '0000000000000000000000', '0110010110000100010111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '54', '1', '0110001000010100001000', '0000101110110110010010', '0100111101101111000000', '1001100110001000100011', '0110010110000100010111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '55', '3', '0110111001110101000001', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '55', '1', '1010101000110000110110', '0000000000000000000000', '0000001001111110000010', '0010001011011111010111', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '56', '3', '0000000000000000000000', '0000000000000000000000', '1001100000001000101111', '1010000110001000110000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '56', '2', '0100100111111000000100', '0000000000000000000000', '1001100000001000101111', '1010000110001000110000', '0111011001000101000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '57', '3', '1100110110011000011101', '0000000000000000000000', '1100000100110101011000', '0000000000000000000000', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '58', '1', '0000000000000000000000', '0000000000000000000000', '0001001011111001010011', '0000100111010111001011', '1110110100000001000111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '59', '1', '1001110001101010011001', '0000000000000000000000', '1001100111111001010111', '1011111011010111110111', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '60', '3', '0000000000000000000000', '0000000000000000000000', '0000100000101101010110', '1000101110111110110111', '0111101011011101000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '60', '1', '0000000000000000000000', '1111101011001101001111', '1011011111100101011000', '1000101110111110110111', '1000110011000011001111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '61', '3', '0000000000000000000000', '0000000000000000000000', '1111111110111011001100', '1110000000001111000100', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '61', '2', '0001111101111111100001', '1110100101011111001011', '1111111110111011001100', '1110000000001111000100', '0111010101001110000111');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '62', '3', '0000000000000000000000', '1101010101110010110001', '1110101100101101100100', '0100100000100011010100', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '62', '2', '0000000000000000000000', '0000011011010011111111', '1110101100101101100100', '0110101011110010100011', '0000000000000000000000');
INSERT INTO `tHorarioAtendimento` (`codigo`, `codMedico`, `codClinica`, `seg`, `ter`, `qua`, `qui`, `sex`) VALUES (NULL, '63', '3', '0000000000000000000000', '0000000000000000000000', '0000000000000000000000', '0010000011100001100100', '0010001100101011000010');


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
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '13', '14');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '14', '28');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '15', '49');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '16', '50');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '16', '16');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '17', '4');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '17', '24');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '18', '2');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '19', '39');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '19', '33');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '20', '48');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '20', '53');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '21', '40');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '21', '38');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '22', '4');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '23', '36');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '23', '44');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '24', '20');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '24', '30');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '25', '33');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '26', '46');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '26', '29');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '27', '46');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '28', '5');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '28', '17');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '29', '11');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '30', '39');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '30', '41');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '31', '50');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '31', '24');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '32', '16');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '32', '54');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '33', '33');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '33', '40');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '34', '14');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '34', '19');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '35', '44');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '35', '35');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '36', '32');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '37', '31');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '37', '33');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '38', '17');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '38', '46');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '39', '29');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '39', '10');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '40', '42');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '41', '5');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '41', '6');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '42', '18');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '43', '10');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '44', '28');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '44', '21');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '45', '9');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '45', '33');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '46', '21');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '47', '21');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '47', '29');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '48', '20');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '49', '33');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '49', '16');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '50', '21');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '50', '7');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '51', '53');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '52', '53');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '53', '54');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '53', '31');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '54', '21');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '55', '22');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '55', '42');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '56', '28');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '57', '54');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '57', '43');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '58', '39');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '58', '30');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '59', '52');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '60', '10');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '61', '37');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '62', '9');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '62', '22');
INSERT INTO `tMedicoEspecialidade` (`codigo`, `codMedico`, `codEspecialidade`) VALUES (NULL, '63', '45');


####### tClinicaMedico #######

USE trabalho;
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '1');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '1');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '2');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '3');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '3');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '4');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '5');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '6');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '7');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '7');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '8');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '9');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '10');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '11');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '11');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '12');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '13');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '14');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '14');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '15');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '15');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '16');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '16');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '17');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '18');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '18');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '19');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '20');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '20');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '21');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '22');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '22');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '23');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '24');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '25');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '26');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '27');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '28');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '28');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '29');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '30');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '31');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '31');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '32');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '32');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '33');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '33');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '34');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '35');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '35');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '36');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '37');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '37');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '38');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '39');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '39');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '40');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '41');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '42');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '43');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '44');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '45');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '46');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '47');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '47');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '48');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '49');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '50');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '50');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '51');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '51');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '52');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '53');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '54');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '55');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '55');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '56');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '57');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '57');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '58');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '59');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '60');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '61');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '3', '62');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '1', '62');
INSERT INTO `tClinicaMedico` (`codigo`, `codClinica`, `codMedico`) VALUES (NULL, '2', '63');


####### tClinicaPaciente #######

USE trabalho;
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '1');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '2');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '3');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '3');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '4');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '5');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '6');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '7');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '8');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '9');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '10');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '10');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '11');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '11');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '12');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '13');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '14');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '15');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '16');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '16');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '17');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '17');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '18');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '18');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '19');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '19');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '20');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '21');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '22');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '23');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '24');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '24');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '25');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '26');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '26');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '27');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '28');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '29');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '30');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '31');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '31');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '32');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '33');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '33');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '34');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '35');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '36');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '37');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '38');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '39');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '39');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '40');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '40');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '41');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '42');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '42');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '43');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '43');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '44');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '45');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '46');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '46');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '47');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '47');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '48');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '49');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '49');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '50');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '51');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '51');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '52');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '52');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '53');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '54');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '55');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '55');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '56');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '57');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '2', '57');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '1', '58');
INSERT INTO `tClinicaPaciente` (`codigo`, `codClinica`, `codPaciente`) VALUES (NULL, '3', '58');


####### tClinicaAtendente #######

INSERT INTO `tClinicaAtendente` (`codigo`, `codClinica`, `codAtendente`) VALUES (NULL, '2', '1');
INSERT INTO `tClinicaAtendente` (`codigo`, `codClinica`, `codAtendente`) VALUES (NULL, '1', '2');
INSERT INTO `tClinicaAtendente` (`codigo`, `codClinica`, `codAtendente`) VALUES (NULL, '3', '3');





