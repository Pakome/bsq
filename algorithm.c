public class MaximumSizeSubMatrix {


    // Compare 3 variables and return tbe smallest one
    private int min(int a,int b, int c){
        int l = Math.min(a, b);
        return Math.min(l, c);
    }
    
    public int maxSize(int arr[][]){
        
        // Verify if there is atleast one 1 in the first column and if there is it is the new max
        int result[][] = new int[arr.length][arr[0].length];
        int max = 0;
        for(int i=0; i < arr.length; i++){
            result[i][0] = arr[i][0];
            if (result[i][0] == 1)
            {
                max = 1;
            }
        }
        
        // Verify if there is atleast one 1 in the first row and if there is it is the new max
        for(int i=0; i < arr[0].length; i++){
            result[0][i] = arr[0][i];
            if (result[0][i] == 1)
            {
                max = 1;
            }  
        }
        
        // Iterate through the whole array and replace the number with the biggest square as number
        for(int i=1; i < arr.length; i++){
            for(int j=1; j < arr[i].length; j++){
                if(arr[i][j] == 0){
                    continue;
                }

                // Check the previous value in the array left, top, and diagonal and take the min + 1
                int t = min(result[i-1][j],result[i-1][j-1],result[i][j-1]);
                result[i][j] =  t +1;

                // Create the new max if one is found
                if(result[i][j] > max){
                    max = result[i][j];
                }
            }
        }
        return max;
    }
    
    
    public static void main(String args[]){
        
        // Create the array
        int arr[][] = {{0,1,1,0,1},{1,1,1,0,0},{1,1,1,1,0},{1,1,1,0,1}};

        // Start the function
        MaximumSizeSubMatrix mssm = new MaximumSizeSubMatrix();

        // Get the result of the algorithm
        int result = mssm.maxSize(arr);

        // Print the result
        System.out.print(result);
    }
    
}