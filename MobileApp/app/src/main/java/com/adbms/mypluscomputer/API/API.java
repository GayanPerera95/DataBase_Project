package com.adbms.mypluscomputer.API;

import com.adbms.mypluscomputer.Customer.Model.Task_Customer_Model;
import com.adbms.mypluscomputer.Employee.Model.Server_Response;
import com.adbms.mypluscomputer.Employee.Model.Task_Model;

import java.util.List;
import java.util.Map;

import retrofit2.Call;
import retrofit2.http.FieldMap;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface API {



    @FormUrlEncoded
    @POST("Employee/getRepairDetails.php")
    Call<List<Task_Model>> getRepairDetails(@FieldMap Map<String,String> fields);





    @FormUrlEncoded
    @POST("Customer/getRepariDetails.php")
    Call<List<Task_Customer_Model>> getRepairCustomerDetails(@FieldMap Map<String,String> fields);





    @FormUrlEncoded
    @POST("Employee/updateRepairDetails.php")
    Call<Server_Response> updateRepairDetails(@FieldMap Map<String,String> fields);

}
