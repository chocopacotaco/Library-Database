package webapp;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet(urlPatterns = "/emp.do")

public class empServlet extends HttpServlet {
	
	

	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		PrintWriter out = response.getWriter();
		
		String ord = DatabaseConnector.getOrderList();
		
		request.setAttribute("Orders",ord);
		
		request.setAttribute("name",request.getParameter("name"));
		request.setAttribute("password",request.getParameter("password"));


		request.getRequestDispatcher("/WEB-INF/views/login.jsp").forward(request, response);

	}
	
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		PrintWriter out = response.getWriter();

		String password = LoginServlet.empSSN;
		
		String BookName = request.getParameter("Book Name");
		
		String memID = request.getParameter("memID");
    	String empID = request.getParameter("empID");
    	
		System.out.println("DoMethod Attempt");
		String ord = DatabaseConnector.getOrderList();
		request.setAttribute("Orders", ord);

        if (request.getParameter("button1") != null) {
    			String[] empInfo = DatabaseConnector.getEmployeeInfo(password);
    			request.setAttribute("info",empInfo);
    			String result[] = DatabaseConnector.getAllEmployeesInfo();
    			ord = DatabaseConnector.getOrderList();
    			request.setAttribute("Orders",ord);
    			request.setAttribute("set", result);
    			request.setAttribute("ssn", password);
    			request.getRequestDispatcher("/WEB-INF/views/EmployeePage.jsp").forward(request, response);
        } else if (request.getParameter("button2") != null) {
			String[] empInfo = DatabaseConnector.getEmployeeInfo(password);
			request.setAttribute("info",empInfo);
			String result[] = DatabaseConnector.getAllMembersInfo();
			ord = DatabaseConnector.getOrderList();
			request.setAttribute("Orders",ord);
			request.setAttribute("set", result);
			request.setAttribute("ssn", password);
			request.getRequestDispatcher("/WEB-INF/views/EmployeePage.jsp").forward(request, response);
        } else if (request.getParameter("button3") != null) {
			String[] empInfo = DatabaseConnector.getEmployeeInfo(password);
			request.setAttribute("info",empInfo);
			String result[] = DatabaseConnector.getAllBooksInfo();
			ord = DatabaseConnector.getOrderList();
			request.setAttribute("Orders",ord);
			request.setAttribute("set", result);
			request.setAttribute("ssn", password);
			request.getRequestDispatcher("/WEB-INF/views/EmployeePage.jsp").forward(request, response);
        }
		System.out.println("DoMethod Attempt error");
		if(BookName != null && BookName != "") {
			String[] empInfo = DatabaseConnector.getEmployeeInfo(password);
			request.setAttribute("info",empInfo);
			String result[] = DatabaseConnector.getAllBooksInfo();
			ord = DatabaseConnector.getOrderList();
			request.setAttribute("Orders",ord);
			DatabaseConnector.getOrderList();
			request.setAttribute("set", result);
			request.setAttribute("ssn", password);
			request.getRequestDispatcher("/WEB-INF/views/EmployeePage.jsp").forward(request, response);
		}else if (memID != null) {
    		memID = request.getParameter("memID");
    		System.out.println("Dropping Member Id:"+memID);
        	DatabaseConnector.dropMember(memID);
			String[] empInfo = DatabaseConnector.getEmployeeInfo(password);
			request.setAttribute("info",empInfo);
			String result[] = DatabaseConnector.getAllBooksInfo();
			ord = DatabaseConnector.getOrderList();
			request.setAttribute("Orders",ord);
			request.setAttribute("set", result);
			request.setAttribute("ssn", password);
			request.getRequestDispatcher("/WEB-INF/views/EmployeePage.jsp").forward(request, response);
        } else if (empID != null) {
    		
        	empID = request.getParameter("empID");
    		System.out.println("Dropping employee Id:"+empID);
        	DatabaseConnector.dropEmployee(empID);
			String[] empInfo = DatabaseConnector.getEmployeeInfo(password);
			request.setAttribute("info",empInfo);
			String result[] = DatabaseConnector.getAllBooksInfo();
			ord = DatabaseConnector.getOrderList();
			request.setAttribute("Orders",ord);
			request.setAttribute("set", result);
			request.setAttribute("ssn", password);
			request.getRequestDispatcher("/WEB-INF/views/EmployeePage.jsp").forward(request, response);
        }

		

	}

}