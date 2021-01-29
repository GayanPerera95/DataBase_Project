package com.adbms.mypluscomputer.Employee.Model;

public class Task_Model {


    private  String Job_id;
    private  String Device_model;
    private  String Serial_number;
    private  String Problem;
    private  Double P_Presant;
    private  String Received_date;
    private  String Customer_Name;
    private  String Customer_Profile;
    private boolean expanded;

    public boolean isExpanded() {
        return expanded;
    }

    public void setExpanded(boolean expanded) {
        this.expanded = expanded;
    }

    public String getJob_id() {
        return Job_id;
    }

    public void setJob_id(String job_id) {
        Job_id = job_id;
    }

    public String getDevice_model() {
        return Device_model;
    }

    public void setDevice_model(String device_model) {
        Device_model = device_model;
    }

    public String getSerial_number() {
        return Serial_number;
    }

    public void setSerial_number(String serial_number) {
        Serial_number = serial_number;
    }

    public String getProblem() {
        return Problem;
    }

    public void setProblem(String problem) {
        Problem = problem;
    }

    public Double getP_Presant() {
        return P_Presant;
    }

    public void setP_Presant(Double p_Presant) {
        P_Presant = p_Presant;
    }

    public String getReceived_date() {
        return Received_date;
    }

    public void setReceived_date(String received_date) {
        Received_date = received_date;
    }

    public String getCustomer_Name() {
        return Customer_Name;
    }

    public void setCustomer_Name(String customer_Name) {
        Customer_Name = customer_Name;
    }

    public String getCustomer_Profile() {
        return Customer_Profile;
    }

    public void setCustomer_Profile(String customer_Profile) {
        Customer_Profile = customer_Profile;
    }
}
