package testOWL;

import com.hp.hpl.jena.ontology.OntModel;
import com.hp.hpl.jena.ontology.OntModelSpec;
import com.hp.hpl.jena.ontology.OntResource;
import com.hp.hpl.jena.rdf.model.*;
import com.hp.hpl.jena.util.FileManager;

import java.io.*;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.Iterator;

/** Tutorial 5 - read RDF XML from a file and write it to standard out
 */
public class Query {

    /**
        NOTE that the file is loaded from the class-path and so requires that
        the data-directory, as well as the directory containing the compiled
        class, must be added to the class-path when running this and
        subsequent examples.
    */    
    static final String inputFileName  = "ricerca_competenze_ontologia.owl";
                              
    public static void main (String args[]) {
    	
    	String SOURCE = "http://www.competenze.com/ontologia";
        String NS = SOURCE + "#";
        
        // create an empty model
    	OntModel model = ModelFactory.createOntologyModel(OntModelSpec.OWL_MEM);

    	InputStream in;
		try {
			Path path = Paths.get(System.getProperty("user.home"),"Desktop/GPS", "ontologia-backup"
					+ ".owl");
			in = new FileInputStream(path.toString());
			// read the RDF/XML file
	        model.read(in, "RDF/XML");
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
        
		// select all the resources with a VCARD.FN property
		// whose value ends with "Smith"
		Property nome = model.getProperty(NS, "nome");
		Property usa = model.getProperty(NS, "richiede");
		StmtIterator iter = model.listStatements(
		    new SimpleSelector(null, nome, (RDFNode) null) {
		        public boolean selects(Statement s)
		            {return s.getString().toLowerCase().contains("android");}
		    }); 
		while (iter.hasNext()) {
            //System.out.println("    " + iter.nextStatement().getObject()
            //                                .toString());
			Resource software = iter.nextStatement().getSubject();
            System.out.println("    " + software);
            StmtIterator iters = software.listProperties(usa);
            while (iters.hasNext()){
            	RDFNode obj = iters.nextStatement().getObject();
            	System.out.println("         "+obj);
            	OntResource lang = obj.as(OntResource.class);
            	Iterator<Resource> iterl = lang.listRDFTypes(true);
            	while(iterl.hasNext()){
            		Resource type = iterl.next();
            		System.out.println("             "+type);
            	}
            }
            //System.out.println(software.getProperty(usa).getObject().toString());
        }
    }
}