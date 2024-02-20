INSERT INTO usuarios(
		usuarios,
		pass,
		TipoUsuario,
		email)
	VALUES('aaa',
		'eee',
		'USER',
		AES_ENCRYPT('derosasjm@gmail.com','aa'));
		
		
select CAST(aes_decrypt(email,'aa') as CHAR) from usuarios;