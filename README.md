# ACSports Custom Theme and Post Types


## Custom "Cards" Post Type

We created a custom post type (CPT) for trading cards. We use [Advanced Custom Fields](https://www.advancedcustomfields.com/) to create custom attributes for this post type. [Gravity Forms](https://www.gravityforms.com/) is used as the form provider to input card data. 

The following will create a new `card` post type:
1. User visits the [trading card page](http://acsportsj.kinsta.cloud/mls/)
2. User fills out the form
3. Form Submit creates a new `card` post from the form data. The [Advanced Post Creation](https://docs.gravityforms.com/category/add-ons-gravity-forms/advanced-post-creation-add-on/) add-on is used to
4. User is directed to the specifc post created by the form submit. Example [here](http://acsportsj.kinsta.cloud/cards/lebron-james/) 


## Custom trading card attributes

Card attributes start with "card_" (that's the word card with an underscore)

- `card_first_name`	 	 = Player First Name
- `card_last_name`  	 = Player Last Name
- `card_sport`			 = Name of the Sport
- `card_team`			 = Name of the Team
- `card_brand`			 = Name of the Brand
- `card_is_graded`		 = Is this card Graded
- `card_grading_company` = The grading company
- `card_grade`	 		 = The grade
- `card_is_pc`			 = Is the card a Personal Collection (PC)
- `card_is_fs`			 = Is the card For Sale (FS)
- `card_is_ft`			 = Is the card For Trade (FT)
- `card_sale_price`		 = Card Sale Price
- `card_trade_demand`	 = Card Trade Demand(s)
- `card_front_image`	 = The front of card image
- `card_back_image`		 = The back of card image
- `card_description`	 = Rich text editor field 

The custom post type (CPT) code is in the child theme [functions.php](https://github.com/tbrennan77/acsports/blob/main/wp-content/themes/buddyboss-theme-child/functions.php) file

`custom_post_type()` is the name of the function that creates the CPT.

## Adding a new Card

1. The MLS form is built with `GravityForms`
2. The `Post Creation` plugin is used to create a post from a GravityForms submit action
3. When the form is submitted is creates a new custom post type of `card`
4. The CPT (custom post type) custom fields are all populated by the data in the form fields
5. When displaying the `card` post you simply reference the custom fields for that post (NOT, the ACF values)

