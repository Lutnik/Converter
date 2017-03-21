#################################################################
#								#	
# 	The converter is a simple demo app written for 		#
# 	recruitment process of a certain company.		#
#								#
# 	It converts one type of file from input directory 	#
# 	into another type and puts it in output directory. 	#
#								#
# 	Resulting file name consists of current date & time. 	#
#								#
# 	Input and output options include			#
#	 	csv, html, json and xml.			#
#								#
#################################################################

Short description of how to use the converter:

Through CLI interface the run.php file executes "convert" command with 2 parameters: input and output extension:

	run.php convert --input="..." --output="..."

or short version:

	run.php convert -i "..." -o "..."

For example, to convert csv file to html type:

	$ php run.php -i csv -o html

#################################################################
#								#
#	About the application:					#
#	- it is based on Symfony 2.6.4 framework		#
#	- OOP-written with common interface 			#
#	  	for all convert methods				#
#	- uses psr-4 class autoloader				#
#	- uses symfony/console module 				#
#								#
#################################################################

#################################################################
#								#
#	Possible upgrades:					#
#	- accept files uploaded from users			#
#	- verify uploaded file content				#
#	- separate convert functionality from read/write	#
#	- add more file types   				#
#	- create a webpage for better user interface		#
#								#
#################################################################

