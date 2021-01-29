package com.adbms.mypluscomputer.Customer.Model;

public class Task_Customer_Model {

    private  String Job_id;
    private  String Device_model;
    private  String Serial_number;
    private  String Problem;
    private  Double P_Presant;
    private  String Received_date;
    private  String Employee_name;
    private  String Employee_Profile;
    private boolean expanded;

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

    public String getEmployee_name() {
        return Employee_name;
    }

    public void setEmployee_name(String employee_name) {
        Employee_name = employee_name;
    }

    public String getEmployee_Profile() {
        return Employee_Profile;
    }

    public void setEmployee_Profile(String employee_Profile) {
        Employee_Profile = employee_Profile;
    }

    public boolean isExpanded() {
        return expanded;
    }

    public void setExpanded(boolean expanded) {
        this.expanded = expanded;
    }
}
