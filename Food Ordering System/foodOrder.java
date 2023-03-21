import java.util.Enumeration;
import java.util.Scanner;
import java.util.Vector;

public class foodOrder {
    public static Scanner sc = new Scanner(System.in);
    public static void main(String[] args) {

        /* 
        Product restaurent[] = new Product[3];
        restaurent[0] = new Product(1,"Beef",16.5);
        restaurent[1] = new Product(2,"Chicken",13.5);
        restaurent[2] = new Product(3,"Lemon Juice",6.5);
        Bill bill = new Bill();
        bill.placeOrder(restaurent[0]);
        bill.placeOrder(restaurent[2]);
        bill.viewOrder();
        bill.deleteOrder(restaurent[0]);
        bill.viewOrder();
        */
        clearConsole();

        Vector<Product> menu = new Vector<Product>(0);
        menu.add(new Product(1,"Beef",16.5));
        menu.add(new Product(2,"Chicken",13.5));
        menu.add(new Product(3,"Lemon Juice",6.5));

        Vector<User> orderList = new Vector<User>(0);

        int run;
        do {
            System.out.print("Welcome to food order system!"
                            +"\n1 - user"
                            +"\n2 - employee"
                            +"\n3 - exit"
                            +"\nEnter your choice : ");
            run = sc.nextInt();

            switch (run) {
                case 1:
                    run = userInterface(menu,orderList);
                    break;
                case 2:
                    run = empInterface(menu,orderList);
                    break;
                case 3:
                    System.out.print("Thank you for using food order system.");
                    run = 0;
                    break;
                default:
                    break;
            }

        }while(run == 1);
        
        sc.close();

    }

    public static void clearConsole() {
        System.out.print("\033[H\033[2J");
        System.out.flush();
    }
    public static void printMenu (Vector<Product> A) {
        System.out.println("\n\n--- Menu ---");
        Enumeration<Product> enumeration = A.elements();
        int index = 1;
        
        while(enumeration.hasMoreElements()){
            System.out.print(index+" ");
            System.out.print(enumeration.nextElement());
            index++;
        }
    }

    public static int userInterface (Vector<Product> A, Vector<User> B) {
        //enter user details
        User a = new User();
        a.enterPhoneNo();
        //start order
        
        int choice;
        do {
            System.out.print("\nPhone No : "+a.getPhoneNo()
                            +"\n1 - place order"
                            +"\n2 - delete order"
                            +"\n3 - view order"
                            +"\n4 - confirm"
                            +"\n5 - cancel"
                            +"\nyour choice : ");
            
            choice = sc.nextInt();
            

            switch (choice) {
                case 1:
                    printMenu(A);
                    System.out.print("Enter product number to place order : ");
                    int add = sc.nextInt()-1;
                    a.bill.placeOrder(A.elementAt(add));
                    break;
                case 2:
                    a.bill.viewOrder();
                    System.out.print("Enter product number to delete order : ");
                    int delete = sc.nextInt()-1;
                    a.bill.deleteOrder(a.bill.getBill().elementAt(delete));
                    break;
                case 3:
                    a.bill.viewOrder();
                    break;
                case 4:
                    System.out.print("Thanks for your order.");
                    B.add(a);
                    break;
                case 5:
                    System.out.print("Thanks you.");
                    break;
                default:
                    System.out.print("Enter valid choice!");
                    break;
            }
        }while (choice != 4 && choice != 5);

        return 1;    
    }

    public static int empInterface (Vector<Product> A, Vector<User> B) {
        //Enter employee details
        Employee emp = new Employee();

        emp.enterEmpDetail();

        //Employee task
        int choice;
        do {
            emp.printEmpDetail();
            System.out.print("1 - add product"
                            +"\n2 - delete product"
                            +"\n3 - view product"
                            +"\n4 - view order list"
                            +"\n5 - log out"
                            +"\nyour choice : ");
            
            choice = sc.nextInt();
            

            switch (choice) {
                case 1:
                    //add product
                    Product a = new Product();
                    a.enterProductDetail();
                    A.add(a);
                    break;
                case 2:
                    //delete product
                    printMenu(A);
                    System.out.print("Enter product number to delete order : ");
                    int delete = sc.nextInt()-1;
                    A.remove(delete);
                    break;
                case 3:
                    //view product
                    printMenu(A);
                    break;
                case 4:
                    //view order list
                    System.out.println("\n\n--- Order List ---");
                    for (int i = 0; i < B.size()-1; i++){
                        System.out.print(B.elementAt(i).getPhoneNo()+"\n");
                        B.elementAt(i).bill.viewOrder();
                    }
                    break;
                case 5:
                    System.out.print("Thanks you.");
                    break;
                default:
                    System.out.print("Enter valid choice!");
                    break;
            }
        }while (choice != 5);

        return 1;
    }
}

class User {
    protected String phone_no;
    protected Bill bill;
    
    User () {
        phone_no="";
        bill = new Bill();
    }
    public void enterPhoneNo() {
        System.out.print("Enter phone number : ");
        Scanner sc = new Scanner(System.in);
        phone_no = sc.next();
    }
    public String getPhoneNo () {
        return "+6"+phone_no;
    }
}
class Employee extends User {
    protected String name;
    protected int emp_id;
    protected String ic;

    Employee () {
        name="";
        emp_id=0;
        ic="";
    }
    public void enterEmpDetail() {
        System.out.print("Enter employee name : ");
        Scanner sc = new Scanner(System.in);
        name = sc.nextLine();

        System.out.print("Enter employee id : ");
        emp_id = sc.nextInt();

        System.out.print("Enter ic (xxxxxxxxxxxx) : ");
        ic = sc.next();

        System.out.print("Enter phone number : ");
        phone_no = sc.next();
    }
    public void printEmpDetail() {
        System.out.println("Name : "+name
                        +"\nEmployee id : "+emp_id
                        +"\nIC number : "+ic
                        +"\nPhone Number : +60"+phone_no);
    }
}

//product
class Product {
    protected int id;
    protected String name;
    protected double price;
    //protected category food;

    Product () {
        id=0;
        name="";
        price=0.0;
    }
    Product (int id, String name, double price) {
        this.id=id;
        this.name=name;
        this.price=price;
    }
    public void enterProductDetail() {
        System.out.print("Enter product id : ");
        Scanner sc = new Scanner(System.in);
        id = sc.nextInt();

        sc.nextLine();
        System.out.print("Enter product name : ");
        name = sc.nextLine();

        System.out.print("Enter product price : ");
        price = sc.nextDouble();

    }
    public String toString () {
        return name+" - RM"+price+"\n";
    }
    public double getPrice () {
        return price;
    }
}

class Bill {
    protected Vector<Product> bill;
    protected double totalPrice;

    Bill () {
        bill = new Vector<Product>(0);
        totalPrice = 0.0;
    }

    public void placeOrder (Product A) {
        bill.add(A);
        totalPrice += A.getPrice();
    }
    public void viewOrder () {
        System.out.println("\n\n--- Bill ---");
        Enumeration<Product> enumeration = bill.elements();
        int index = 1;
        while(enumeration.hasMoreElements()){
            System.out.print(index+" ");
            System.out.print(enumeration.nextElement());
            index++;
        }
        System.out.println("Total price : "+totalPrice+"\n\n");

    }
    public void deleteOrder (Product A) {
        bill.remove(A);
        totalPrice -= A.getPrice();
    }

    public Vector<Product> getBill () {
        return bill;
    }

}