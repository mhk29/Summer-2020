function f = getmidslice(file)

V = niftiread(file);
P = V(:,:,size(V,3)./2); %% middle slice in axial directiom
preQ = V(:,size(V,2)./2,:); %% middle slice in sagittal direction
preR = V(size(V,1)./2,:,:); %% middle slice in coronal direction

for m=1:size(V,1)
	for k=1:size(V,3)
		Q(m,k)=preQ(m,1,k); 
	end
end

for b=1:size(V,2)
	for l=1:size(V,3)
		R(b,l)=preR(1,b,l);
	end
end

fileName = file;
dotLocations = find(fileName == '.')
if isempty(dotLocations)
	newf = fileName
else 
	newf = fileName(1:dotLocations(1)-1)
end

imwrite(3.27675*P,'mid/axial/'+ newf +'.png');
imwrite(3.27675*Q,'mid/sagittal/'+ newf +'.png');
imwrite(3.27675*R,'mid/coronal/'+ newf +'.png');

end 