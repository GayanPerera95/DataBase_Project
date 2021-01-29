

---final  Quarys

-- for sales and stock managemnt 



--funcation for to get quanty of purches by customers 

1)
--funcation one for serach 
Create function getCustomerQuantity(@Product_id as int)
Returns int
As
Begin 
Return (
    Select  
	ISNULL(SUM(Quantity), 0 ) As 'Customer_Orders'
	From
	 Customer_order_payment
	Where   Product_id=@Product_id

)
End
--Test it 
select dbo.getCustomerQuantity(1010)

2)


Create function getStockQuantity(@Product_id as int)
Returns int
As Begin 
Return (
    Select  
      ISNULL(SUM(Quantity), 0 )
	From
	 Stock
	Where   Stock.Product_id=@Product_id
)
End


3)
Create function getRecevialStockQuantity(@Product_id as int)
Returns int
As Begin 
Return (
  Select  
  ISNULL(SUM(Supplied_quantity), 0 )
  From
	Supplier_stock_receival
	Where   Supplier_stock_receival.Product_id=@Product_id
)
End




---------------------------SerachBar-----------------------------------






CREATE PROCEDURE dbo.SearchEngine  
			
			@option1  as nvarchar(70),
			@option2  as nvarchar(70),
			@option3  as nvarchar(70),
			@option4  as nvarchar(70),
			@SearchText  as nvarchar(70),
			@Sort_Order  as nvarchar(70),
			@isTagOnly  as nvarchar(70)
			As 
			Begin
			if(@isTagOnly='TRUE')
					if(@Sort_Order='ASC')
					Begin
					SELECT *, Product.Product_id,
					dbo.getCustomerQuantity(Product.Product_id) As 'Customer_Orders' ,
					dbo.getStockQuantity(Product.Product_id) As 'Stock_Quantity',

					dbo.getRecevialStockQuantity(Product.Product_id) As 'RecivalStock_Quantitiy'


					FROM Product 
					Inner join Category on Category.Category_no= Product.Category_no

					where (
					(Category.Category_description = @option1
					Or
					Category.Category_description = @option2

					Or
					Category.Category_description = @option3

					or
					Category.Category_description = @option4 

					) 
					
					)
						Order by Product.Price ASC;
						END	
					ELSE 
					BEGIN
						SELECT *, Product.Product_id,
					dbo.getCustomerQuantity(Product.Product_id) As 'Customer_Orders' ,
					dbo.getStockQuantity(Product.Product_id) As 'Stock_Quantity',

					dbo.getRecevialStockQuantity(Product.Product_id) As 'RecivalStock_Quantitiy'


					FROM Product 
					Inner join Category on Category.Category_no= Product.Category_no

					where (
					(Category.Category_description = @option1
					Or
					Category.Category_description = @option2

					Or
					Category.Category_description = @option3

					or
					Category.Category_description = @option4 

					) 
					
					)
						Order by Product.Price DESC;
						END
				
			Else
					if(@Sort_Order='ASC')
					Begin
					SELECT *, Product.Product_id,
					dbo.getCustomerQuantity(Product.Product_id) As 'Customer_Orders' ,
					dbo.getStockQuantity(Product.Product_id) As 'Stock_Quantity',

					dbo.getRecevialStockQuantity(Product.Product_id) As 'RecivalStock_Quantitiy'


					FROM Product 
					Inner join Category on Category.Category_no= Product.Category_no

					where (
					(Category.Category_description = @option1
					Or
					Category.Category_description = @option2

					Or
					Category.Category_description = @option3

					or
					Category.Category_description = @option4 

					) or (
					Product.Name like @SearchText
					)
					
					)
						Order by Product.Price ASC;
						END	
					ELSE 
					BEGIN
						SELECT *, Product.Product_id,
					dbo.getCustomerQuantity(Product.Product_id) As 'Customer_Orders' ,
					dbo.getStockQuantity(Product.Product_id) As 'Stock_Quantity',

					dbo.getRecevialStockQuantity(Product.Product_id) As 'RecivalStock_Quantitiy'


					FROM Product 
					Inner join Category on Category.Category_no= Product.Category_no

					where (
					(Category.Category_description = @option1
					Or
					Category.Category_description = @option2

					Or
					Category.Category_description = @option3

					or
					Category.Category_description = @option4 

					) 
					or (
					Product.Name like @SearchText
					)
					)
						Order by Product.Price DESC;
						END
			END



--user for serach enging testing 

EXEC  dbo.SearchEngine

@option1 ='Computer item',
@option2 ='',
@option3 ='',
@option4 ='',
@SearchText  ='%KeyBoard%',
@Sort_Order ='DESC',
@isTagOnly='TRUE'


GO



----------------------------------------

CREATE VIEW ShowStockDetails
AS

SElECT
Product.Product_id,
Product.Name as 'Product_Name',
Product.Price,
Product.Discount,
Product_inclusion_in_stock.Stock_quantity as 'InclusionStock',
dbo.getCustomerQuantity(Product.Product_id) As 'Customer_Orders' ,
dbo.getStockQuantity(Product.Product_id) As 'Stock_Quantity',
dbo.getRecevialStockQuantity(Product.Product_id) As 'RecivalStock_Quantitiy'


FROM Product 
Inner join Category on Category.Category_no= Product.Category_no
Inner join Product_inclusion_in_stock on Product_inclusion_in_stock.Product_id= Product.Product_id



-- to test

SELECT 
    * 
FROM 

ShowStockDetails




--- chart in sales screen 
1)
Create Procedure getStockForChart

As
Begin

Select Product.Name as 'Product_Name',
 count(Stock.Quantity) as 'Quanitity'
From Stock
Inner Join Product on Product.Product_id=Stock.Product_id
Group by Product.Name

END




--test

EXEC  dbo.getStockForChart
GO




2)

Create Procedure getStockForLineChart

As
Begin

Select  Product.Name as 'Product_Name',

count(Customer_order_payment.Quantity) as 'Quanitity'


From Customer_order_payment

Inner join Product on Product.Product_id=Customer_order_payment.Product_id
Group by Product.Name

END

--test
EXEC  dbo.getStockForLineChart



