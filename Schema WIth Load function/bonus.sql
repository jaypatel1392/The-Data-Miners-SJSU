CREATE DEFINER=`root`@`localhost` TRIGGER bonus
AFTER INSERT ON rating 
FOR EACH ROW 
BEGIN
	IF (new.rating >= 4) THEN
		UPDATE employee
		SET salary = salary + 10
		WHERE employee.hID = new.hID;
	END IF ;
END