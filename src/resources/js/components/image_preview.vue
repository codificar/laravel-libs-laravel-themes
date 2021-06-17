<template>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label> {{ label }} </label>
				<div :id="'image-preview-'+fieldName" class="image-preview" >
					<label :for="'image-'+fieldName" :id="'image-picture-label-'+fieldName">{{ trans.choose }}</label>
					<input type="file" :id="'image-'+fieldName" name="image-input" v-on:change="onImageChange" class="form-control" data-max-file-size="12M" accept=".JPEG, .jpg, .png"/>
				</div>
				<div class="help-block with-errors"></div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	name: 'ImagePreview',
	data() {
		return {
			image: ''
		}
	},
	props: {
		imageUrl: String,
		label: String,
		fieldName: String,
		trans: Object
	},

	mounted() {
		if(this.imageUrl) { document.getElementById("image-preview-"+this.fieldName).style.backgroundImage = "url(" + this.imageUrl + ")"; }
	},

	methods: {
		onImageChange(e){
			this.image = e.target.files[0];
			this.readImage(this.image)
		},
		readImage(image) {
			var reader = new FileReader();
			var _this = this;
			reader.onloadend = function(){
				document.getElementById("image-preview-"+_this.fieldName).style.backgroundImage = "url(" + reader.result + ")";
				_this.$emit('update', { image: _this.image, fieldName: _this.fieldName } )
			}
			if(image){
				reader.readAsDataURL(image);
			}
		}
	},
}
</script>
