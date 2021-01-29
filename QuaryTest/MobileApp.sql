
Create Procedure getRepairDetailsByToMobileApp
			@SearchText  as nvarchar(70),
			@emp_id  as int
			As
			Begin

SELECT  

Repair_item.Job_id,
Repair_item.Device_model,
Repair_item.Serial_number,
Repair_item.Problem,
Repair_item.P_Presant,
Repair_item.Received_date,
Customer.Cus_fname,
Customer.Cus_lname,
Customer.Image as 'Customer Profile'


From 

Repair_item

Inner join Employee on Employee.Emp_id =Repair_item.Emp_id
Inner join Customer on Customer.Customer_id=Repair_item.Customer_id

where Employee.Emp_id=@emp_id
And

(Repair_item.Device_model like @SearchText or Repair_item.Problem like @SearchText)

Order by Repair_item.Received_date DESC
;

End;





-- to test
EXEC  dbo.getRepairDetailsByToMobileApp
@SearchText  ='%Screen%',
@emp_id ='100'
GO



--update the work precentage
Create Procedure updateRepairDetailsByToMobileApp
			@Job_id as int,
			@emp_id  as int,
			@Presentage  as nvarchar(70)


			As
			Begin

update Repair_item set P_Presant=@Presentage where (Job_id=@Job_id And Emp_id=@emp_id)

End;


-- to test
EXEC  dbo.updateRepairDetailsByToMobileApp
@Job_id  ='1',
@emp_id ='100',
@Presentage ='50'
GO






Create Procedure getRepairCustomerDetailsByToMobileApp
			@SearchText  as nvarchar(70),
			@Customer_id  as int
			As
			Begin


SELECT 

Repair_item.Job_id,
Repair_item.Device_model,
Repair_item.Serial_number,
Repair_item.Problem,
Repair_item.P_Presant,
Repair_item.Received_date,
Employee.Emp_fname,
Employee.Emp_lname,
Employee.Image as 'Employee_Profile'


From 

Repair_item

Inner join Employee on Employee.Emp_id =Repair_item.Emp_id
Inner join Customer on Customer.Customer_id=Repair_item.Customer_id

where Customer.Customer_id=@Customer_id
And

(Repair_item.Device_model like 	@SearchText or Repair_item.Problem like @SearchText)

Order by Repair_item.Received_date DESC

End;





-- to test
EXEC  dbo.getRepairCustomerDetailsByToMobileApp
@SearchText  ='%%',
@Customer_id ='10027052'
GO

