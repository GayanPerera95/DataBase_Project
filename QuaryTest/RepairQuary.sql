-- to retive data from tabelles 


Select Repair_item.Job_id,Repair_item.Device_model,Repair_item.Serial_number,Repair_item.Problem,Repair_item.Received_date,Repair_item.P_Presant,
Employee.Emp_fname,Employee.Emp_lname,Employee.Image,
Customer.Cus_fname,Customer.Cus_lname,Customer.Phone_no
from Repair_item
inner join Employee on Repair_item.Emp_id=Employee.Emp_id
inner join Customer on Repair_item.Customer_id=Customer.Customer_id
Go


-- create funcation fro get available balance 


Create function getAvailableBalance(@Advance_paid as money ,@Sub_total as money)
Returns money
As
Begin
Return (@Sub_total- @Advance_paid)
end


-- after marge all those thing to ge what i need



Select Repair_item.Job_id,Repair_item.Device_model,Repair_item.Serial_number,Repair_item.Problem,Repair_item.Received_date,Repair_item.P_Presant,
Employee.Emp_fname,Employee.Emp_lname,Employee.Image,
Customer.Cus_fname,Customer.Cus_lname,Customer.Phone_no,
Repair_payment.Advance_paid,Repair_payment.Sub_total,
dbo.getAvailableBalance(Repair_payment.Advance_paid,Repair_payment.Sub_total) AS 'AvailableBlanace'

from Repair_item
inner join Employee on Repair_item.Emp_id=Employee.Emp_id
inner join Customer on Repair_item.Customer_id=Customer.Customer_id
inner join Repair_payment on Repair_item.Job_id=Repair_payment.Rep_id

Go




-- Create Procedure getRepairDetails
Create Procedure getRepairDetails
As 
Begin

Select Repair_item.Job_id,Repair_item.Device_model,Repair_item.Serial_number,Repair_item.Problem,Repair_item.Received_date,Repair_item.P_Presant,
Employee.Emp_fname,Employee.Emp_lname,Employee.Image,
Customer.Cus_fname,Customer.Cus_lname,Customer.Phone_no,
Repair_payment.Advance_paid,Repair_payment.Sub_total,
dbo.getAvailableBalance(Repair_payment.Advance_paid,Repair_payment.Sub_total) AS 'AvailableBlanace'

from Repair_item
inner join Employee on Repair_item.Emp_id=Employee.Emp_id
inner join Customer on Repair_item.Customer_id=Customer.Customer_id
inner join Repair_payment on Repair_item.Job_id=Repair_payment.Rep_id

End





--create procedure for serach RepairPeocess

Create Procedure getRepairDetailsBySerach
			@SearchText  as nvarchar(70)
			As
			Begin

			Select Repair_item.Job_id,Repair_item.Device_model,Repair_item.Serial_number,Repair_item.Problem,Repair_item.Received_date,Repair_item.P_Presant,
			Employee.Emp_fname,Employee.Emp_lname,Employee.Image,
			Customer.Cus_fname,Customer.Cus_lname,Customer.Phone_no,
			Repair_payment.Advance_paid,Repair_payment.Sub_total,
			dbo.getAvailableBalance(Repair_payment.Advance_paid,Repair_payment.Sub_total) AS 'AvailableBlanace'

			from Repair_item
			inner join Employee on Repair_item.Emp_id=Employee.Emp_id
			inner join Customer on Repair_item.Customer_id=Customer.Customer_id
			inner join Repair_payment on Repair_item.Job_id=Repair_payment.Rep_id


			Where (

			Repair_item.Job_id like  @SearchText 
			or 
			Customer.Cus_fname like  @SearchText
			)

END



-- to test
EXEC  dbo.getRepairDetailsBySerach
@SearchText  ='%1%'
GO




-- create view to show  RepairDetails

CREATE VIEW RepairDetails
AS

SELECT
    year(Repair_item.Received_date) AS RpY,
    month(Repair_item.Received_date) AS RpM,
    day(Repair_item.Received_date) AS RpD,

Repair_item.Job_id,Repair_item.Device_model,Repair_item.Serial_number,Repair_item.Problem,Repair_item.Received_date,Repair_item.P_Presant,
Employee.Emp_fname,Employee.Emp_lname,Employee.Image,
Customer.Cus_fname,Customer.Cus_lname,Customer.Phone_no,
Repair_payment.Advance_paid,Repair_payment.Sub_total,
dbo.getAvailableBalance(Repair_payment.Advance_paid,Repair_payment.Sub_total) AS 'AvailableBlanace'

from Repair_item
inner join Employee on Repair_item.Emp_id=Employee.Emp_id
inner join Customer on Repair_item.Customer_id=Customer.Customer_id
inner join Repair_payment on Repair_item.Job_id=Repair_payment.Rep_id
;








-- 3) Search bar 
3)---for repair screnn  to get letest update 

Create Procedure getRepairDetailsForLineChart

As
Begin

SELECT 
Repair_item.Received_date as 'Recevied_Date' ,

count(Repair_item.Job_id) as 'Number_of_items'


From Repair_item

Group by Repair_item.Received_date


 ORDER BY Repair_item.Received_date desc


END


--test

EXEC  dbo.getRepairDetailsForLineChart














