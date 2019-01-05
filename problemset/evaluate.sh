#/bin/bash/
# parameter 1 = compilers name
# parameter 2 = source code's name
# parameter 3 = problem's name
# parameter 4 = Time limit


# return values
# 0 = Correct Answer
# 1 = Wrong Answer
# 2 = Compilation Error
# 3 = Run time Error
# 4 = Time limit exceeded
echo $1,$2,$3,$4
path_to_file=$3'/uploads/'$2
echo $path_to_file
if [ $1 == 'C' ]
then
  gcc -lm $path_to_file -o $3/'testing_files'/a.out  > $3/'testing_files'/output 2> $3/'testing_files'/error #compiling file and redirecting ouput
  if [ $? -eq 0 ]
  then
    echo 'Compilation Successful'
    timeout $4 $3/'testing_files'/a.out <$3/'testing_files'/test_input #running file on test data and redirecting ouput
    if [ $? -eq 124 ]
    then
      echo "Time Limit exceeded";
      exit 4;
    else
      $3/'testing_files'/a.out <$3/'testing_files'/test_input > $3/'testing_files'/output 2> $3/'testing_files'/error
      if [ $? -eq 0 ]
      then
        diff $3/'testing_files'/output $3/'testing_files'/real_output #Using diff to check if answer is Correct
        if [ $? -eq 0 ]
        then
          echo "Correct Answer";
	        exit 0;
        else
          echo "Wrong Answer";
	        exit 1;
        fi
      else # If Run wasn't Successful
        echo 'Run time error'
	exit 3;
      fi
    fi
    rm $3/'testing_files'/a.out
  else
    echo 'compile time error'
    exit 2;
  fi
elif [ $1 == 'C++' ]
then
  g++ $path_to_file -o $3/'testing_files'/a.out > $3/'testing_files'/output 2> $3/'testing_files'/error #compiling file and redirecting ouput
  if [ $? -eq 0 ]
  then
    echo 'Compilation Successful'
    timeout $4 $3/'testing_files'/a.out <$3/'testing_files'/test_input #running file on test data and redirecting ouput
    if [ $? -eq 124 ]
    then
      echo "Time Limit exceeded";
      exit 4;
    else
      $3/'testing_files'/a.out <$3/'testing_files'/test_input > $3/'testing_files'/output 2> $3/'testing_files'/error
      if [ $? -eq 0 ]
      then
        diff $3/'testing_files'/output $3/'testing_files'/real_output #Using diff to check if answer is Correct
        if [ $? -eq 0 ]
        then
          echo "Correct Answer";
	  exit 0;
        else
          echo "Wrong Answer";
	  exit 1;
        fi
      else # If Run wasn't Successful
        echo 'Run time error'
	exit 3;
      fi
    fi
    rm $3/'testing_files'/a.out
  else
    echo 'compile time error'
    exit 2;
  fi
elif [ $1 == 'Java' ]
then
  javac -d $3/'testing_files' $path_to_file > $3/'testing_files'/output 2> $3/'testing_files'/error #compiling file and redirecting ouput
  if [ $? -eq 0 ]
  then
    echo 'Compilation Successful'
    len=${#2}
	var=${2::len-5}
    timeout $4 java -cp $3/'testing_files' $var <$3/'testing_files'/test_input #running file on test data and redirecting ouput
    if [ $? -eq 124 ]
    then
      echo "Time Limit exceeded";
      exit 4;
    else
      java -cp $3/'testing_files' $var <$3/'testing_files'/test_input > $3/'testing_files'/output
      if [ $? -eq 0 ]
      then
        diff $3/'testing_files'/output $3/'testing_files'/real_output #in case of success print output
        if [ $? -eq 0 ]
        then
          echo "Correct Answer";
 	  exit 0;
        else
          echo "Wrong Answer";
	  exit 1;
        fi
      else
        echo 'Run time error' #in case of error print error
	exit 3;
      fi
    fi
    rm $3/'testing_files'/$var".class"
  else
    echo 'compile time error'
    exit 2;
  fi
elif [ $1 == 'Python' ]
then
  echo -n "" > $3/'testing_files'/error;
  timeout $4 python3 $path_to_file 2> $3/'testing_files'/error #compiling file and redirecting ouput
  if [ -s $3/'testing_files'/error ]
  then
    echo "Syntax error";
    exit 2;
  else
    echo "Compilation Successful";
    timeout $4 python3 $path_to_file<$3/'testing_files'/test_input 2> $3/'testing_files'/error #compiling file and redirecting ouput
    if [ $? -eq 124 ]
    then
      echo "Time Limit exceeded";
      exit 4;
    else
      echo python3 $path_to_file <$3/'testing_files'/test_input > $3/'testing_files'/output 2> $3/'testing_files'/error;
      python3 $path_to_file <$3/'testing_files'/test_input > $3/'testing_files'/output 2> $3/'testing_files'/error
      # echo $?;
      if [ $? -eq 0 ]
      then
    	    diff $3/'testing_files'/output $3/'testing_files'/real_output #in case of success print output
    	    if [ $? -eq 0 ]
    	    then
    	      echo "Correct Answer";
	      exit 0;
    	    else
    	      echo "Wrong Answer";
	      exit 1;
    	    fi
    	  else
    	    echo 'Run time error' #in case of error print error
	    exit 3;
        fi
      fi
    fi
  fi
