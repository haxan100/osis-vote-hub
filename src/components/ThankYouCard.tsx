import { Card } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { CheckCircle2 } from "lucide-react";
import { Candidate } from "@/pages/Voting";

interface ThankYouCardProps {
  candidate: Candidate;
}

const ThankYouCard = ({ candidate }: ThankYouCardProps) => {
  return (
    <div className="max-w-2xl mx-auto animate-scale-in">
      <Card className="rounded-[20px] shadow-soft overflow-hidden">
        <div className="gradient-primary p-8 text-center text-primary-foreground">
          <CheckCircle2 className="w-16 h-16 mx-auto mb-4" />
          <h2 className="text-3xl font-bold mb-2">Terima Kasih!</h2>
          <p className="text-lg opacity-90">
            Suara Anda telah berhasil disimpan
          </p>
        </div>
        
        <div className="p-8">
          <div className="flex items-center justify-center gap-2 mb-6">
            <span className="text-muted-foreground">Status:</span>
            <Badge className="bg-success">Sudah Memilih</Badge>
          </div>
          
          <div className="bg-muted rounded-[20px] p-6 space-y-4">
            <h3 className="text-xl font-semibold text-center text-foreground mb-4">
              Pilihan Anda
            </h3>
            
            <div className="flex items-center gap-4">
              <div className="w-16 h-16 rounded-full gradient-primary flex items-center justify-center shrink-0">
                <span className="text-3xl font-bold text-primary-foreground">
                  {candidate.number}
                </span>
              </div>
              
              <div className="flex-1">
                <h4 className="text-lg font-bold text-foreground">
                  {candidate.president}
                </h4>
                <p className="text-muted-foreground">
                  & {candidate.vicePresident}
                </p>
              </div>
            </div>
            
            <div className="pt-4 border-t border-border">
              <p className="text-sm text-muted-foreground italic">
                "{candidate.shortVision}"
              </p>
            </div>
          </div>
          
          <p className="text-center text-muted-foreground mt-6 text-sm">
            Pilihan Anda tidak dapat diubah. Terima kasih atas partisipasinya!
          </p>
        </div>
      </Card>
    </div>
  );
};

export default ThankYouCard;
