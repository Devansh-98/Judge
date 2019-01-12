from captcha.image import ImageCaptcha
import matplotlib.pyplot as plt
import random

number_list = ['0','1','2','3','4','5','6','7','8','9']
alphabet_uppercase = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z']

def create_captcha_text(captcha_string_size=4):
	captcha_string_list = []
	base_characters = alphabet_uppercase + number_list

	for i in range(captcha_string_size):
		char = random.choice(base_characters)
		captcha_string_list.append(char)

	captcha_string = ''

	for item in captcha_string_list:
		captcha_string += str(item)

	return captcha_string

def create_captcha_image(captcha_string):
	image_captcha = ImageCaptcha(font_sizes=[50])

	image = image_captcha.generate_image(captcha_string)

	image_captcha.create_noise_dots(image, image.getcolors())

	image_captcha.create_noise_curve(image, image.getcolors())

	image_file = "./color_generated_captcha_images/" + captcha_string + ".png"

	image_captcha.write(captcha_string, image_file)

	print(image_file + " has been created.")
from random import randint
if __name__ == '__main__':
	random_number = randint(20,50)
	for i in range(1,random_number, 1):
		captcha_string = create_captcha_text()
		create_captcha_image(captcha_string)

